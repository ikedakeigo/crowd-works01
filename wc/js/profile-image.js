jQuery(function($){

	/**
	 * プロフィール画像
	 */
	if ($('.edit-account .profile-image').length) {
		var $image_area = $('.edit-account .profile-image');
		var $profile_image_file = $image_area.find('[name="profile_image_file"]');
		var $profile_image_url = $image_area.find('[name="profile_image_url"]');
		var $uploaded_profile_image_url = $image_area.find('[name="uploaded_profile_image_url"]');
		var $image_current = $image_area.find('.profile-image__image-current');
		var $image_bg = $image_area.find('.profile-image__image-bg');
		var $upload_button = $image_area.find('.profile-image__upload-button');
		var $delete_button = $image_area.find('.profile-image__delete-button');

		// 画像開く
		$upload_button.on('click', function() {
			$profile_image_file.trigger('click');
			return false;
		});

		// 画像選択
		$profile_image_file.on('change', function() {
			if (this.files.length > 0) {
				if(!this.files[0].type.match(/^image\/(png|jpeg|gif)$/)) {
					alert(TCD_PROFILE_IMAGE.not_image_file);
					this.value = '';
					return false;
				}

				uploadImagePreview($image_current, this.files[0]);
				check_delete_button();
			}
		});
		// リロード対策
		$profile_image_file.trigger('change');

		// 画像削除
		$delete_button.on('click', function() {
			var replace_image_url;

			if ($profile_image_file.val()) {
				$profile_image_file.val('');
				$image_current.removeClass('has-upload-preview');

				if ($uploaded_profile_image_url.val()) {
					replace_image_url = $uploaded_profile_image_url.val();
				} else if ($profile_image_url.val()) {
					replace_image_url = $profile_image_url.val();
				}
			} else if ($uploaded_profile_image_url.val()) {
				$uploaded_profile_image_url.val('');

				if ($profile_image_url.val()) {
					replace_image_url = $profile_image_url.val();
				}
			} else if ($profile_image_url.val()) {
				$profile_image_url.val('');

				// 現画像削除フラグ追加
				$image_area.append('<input type="hidden" name="delete-image-profile_image" value="1">');
			}

			if (replace_image_url) {
				$image_current.css('background-image', 'url("' + replace_image_url + '")');
			} else {
				$image_current.attr('style', '');
			}

			check_delete_button();

			return false;
		});

		// 画像削除ボタン表示
		var check_delete_button = function() {
			if ($profile_image_file.val() || $uploaded_profile_image_url.val() || $profile_image_url.val()) {
				$image_bg.hide();
				$delete_button.show();
			} else {
				$image_bg.show();
				$delete_button.hide();
			}
		};
		check_delete_button();

		/**
		 * 画像プレビュー
		 * 参考 https://egashira.jp/image-resize-before-upload
		 */
		var uploadImagePreview = function($target, file) {
			$target = $($target);

			if (!$target.length || !file || !file.type.match(/^image\/(png|jpeg|gif)$/)) return;

			// 縮小する画像のサイズ
			var maxWidth = 300;
			var maxHeight = 300;
			var crop = 1;

			var img = new Image();
			var reader = new FileReader();

			reader.onload = function(e) {
				var data = this.result;

				img.onload = function() {
					var iw = img.naturalWidth, ih = img.naturalHeight;
					var width = iw, height = ih;
					var orientation;

					// JPEGの場合には、EXIFからOrientation（回転）情報を取得
					if (data.split(',')[0].match('jpeg')) {
						orientation = getOrientation(data);
					}
					// JPEG以外や、JPEGでもEXIFが無い場合などには、標準の値に設定
					orientation = orientation || 1;

					// 90度回転など、縦横が入れ替わる場合には事前に最大幅、高さを入れ替えておく
					if (orientation > 4) {
						var tmpMaxWidth = maxWidth;
						maxWidth = maxHeight;
						maxHeight = tmpMaxWidth;
					}

					// 縮小画像サイズ計算
					var cropWidth = 0, cropHeight = 0;
					if (width > maxWidth || height > maxHeight) {
						if (crop) {
							if (width >= maxWidth && height >= maxHeight) {
								if (height / width < maxHeight / maxWidth) {
									width = Math.round(width * maxHeight / height );
									height = maxHeight;
									cropSx = Math.floor( (width - maxWidth) / 2 );
									cropWidth = maxWidth;
									cropHeight = height;
								} else {
									height = Math.round(height * maxWidth / width );
									width = maxWidth;
									cropSy = Math.floor( (height - maxHeight) / 2 );
									cropWidth = width;
									cropHeight = maxHeight;
								}
							} else if (width > maxWidth) {
								cropWidth = maxWidth
								cropHeight = height;
							} else if (height > maxHeight) {
								cropWidth = width;
								cropHeight = maxHeight;
							}
						} else {
							var ratio = width/maxWidth;
							if (ratio <= height/maxHeight) {
								ratio = height/maxHeight;
							}

							width = Math.round(iw/ratio);
							height = Math.round(ih/ratio);
						}
					}

					var canvas = document.createElement('canvas');
					var ctx = canvas.getContext('2d');
					ctx.save();

					// EXIFのOrientation情報からCanvasを回転させておく
					transformCoordinate(canvas, width, height, orientation);

					// iPhoneのサブサンプリング問題の回避
					// see http://d.hatena.ne.jp/shinichitomita/20120927/1348726674
					var subsampled = detectSubsampling(img);
					if (subsampled) {
						iw /= 2;
						ih /= 2;
					}

					// Orientation聞かせながらタイルレンダリング
					var d = 1024; // size of tiling canvas
					var tmpCanvas = document.createElement('canvas');
					tmpCanvas.width = tmpCanvas.height = d;
					var tmpCtx = tmpCanvas.getContext('2d');
					var vertSquashRatio = detectVerticalSquash(img, iw, ih);
					var dw = Math.ceil(d * width / iw);
					var dh = Math.ceil(d * height / ih / vertSquashRatio);
					var sy = 0;
					var dy = 0;
					while (sy < ih) {
						var sx = 0;
						var dx = 0;
						while (sx < iw) {
							tmpCtx.clearRect(0, 0, d, d);
							tmpCtx.drawImage(img, -sx, -sy);
							// 何度もImageDataオブジェクトとCanvasの変換を行ってるけど、Orientation関連で仕方ない。本当はputImageDataであれば良いけどOrientation効かない
							var imageData = tmpCtx.getImageData(0, 0, d, d);
							var resampled = resampleHermite(imageData, d, d, dw, dh);
							ctx.drawImage(resampled, 0, 0, dw, dh, dx, dy, dw, dh);
							sx += d;
							dx += dw;
						}
						sy += d;
						dy += dh;
					}
					ctx.restore();

					var resizedSrc;

					// 切り抜き
					if (cropWidth && cropHeight) {
						var offsetX = Math.floor(canvas.width - cropWidth) / 2;
						var offsetY = Math.floor(canvas.height - cropHeight) / 2;

						// リサイズ後のcanvasから切り抜きしてtmpCanvasに張り付け
						var imageData = ctx.getImageData(offsetX, offsetY, cropWidth, cropHeight);
						tmpCanvas.width = cropWidth;
						tmpCanvas.height = cropHeight;
						tmpCtx.putImageData(imageData, 0, 0);

						canvas = ctx = null;

						// 切り抜き後のbase64形式の画像データ取得
						resizedSrc = tmpCtx.canvas.toDataURL('image/jpeg', 0.9);

						tmpCanvas = tmpCtx = null;
					} else {
						tmpCanvas = tmpCtx = null;

						// リサイズ後のbase64形式の画像データ取得
						resizedSrc = ctx.canvas.toDataURL('image/jpeg', 0.9);

						canvas = ctx = null;
					}

					// $targetの背景画像にセット
					$target.addClass('has-upload-preview').css('background-image', 'url("' + resizedSrc + '")');
				}
				img.src = data;
			}
			reader.readAsDataURL(file);

			// hermite filterかけてジャギーを削除する
			function resampleHermite(img, W, H, W2, H2){
				var canvas = document.createElement('canvas');
				canvas.width = W2;
				canvas.height = H2;
				var ctx = canvas.getContext('2d');
				var img2 = ctx.createImageData(W2, H2);
				var data = img.data;
				var data2 = img2.data;
				var ratio_w = W / W2;
				var ratio_h = H / H2;
				var ratio_w_half = Math.ceil(ratio_w/2);
				var ratio_h_half = Math.ceil(ratio_h/2);
				for(var j = 0; j < H2; j++){
					for(var i = 0; i < W2; i++){
						var x2 = (i + j*W2) * 4;
						var weight = 0;
						var weights = 0;
						var gx_r = 0, gx_g = 0, gx_b = 0, gx_a = 0;
						var center_y = (j + 0.5) * ratio_h;
						for(var yy = Math.floor(j * ratio_h); yy < (j + 1) * ratio_h; yy++){
							var dy = Math.abs(center_y - (yy + 0.5)) / ratio_h_half;
							var center_x = (i + 0.5) * ratio_w;
							var w0 = dy*dy;
							for(var xx = Math.floor(i * ratio_w); xx < (i + 1) * ratio_w; xx++){
								var dx = Math.abs(center_x - (xx + 0.5)) / ratio_w_half;
								var w = Math.sqrt(w0 + dx*dx);
								if(w >= -1 && w <= 1){
									weight = 2 * w*w*w - 3*w*w + 1;
									if(weight > 0){
										dx = 4*(xx + yy*W);
										gx_r += weight * data[dx];
										gx_g += weight * data[dx + 1];
										gx_b += weight * data[dx + 2];
										gx_a += weight * data[dx + 3];
										weights += weight;
									}
								}
							}
						}
						data2[x2]		 = gx_r / weights;
						data2[x2 + 1] = gx_g / weights;
						data2[x2 + 2] = gx_b / weights;
						data2[x2 + 3] = gx_a / weights;
					}
				}
				ctx.putImageData(img2, 0, 0);
				return canvas;
			};

			// JPEGのEXIFからOrientationのみを取得する
			function getOrientation(imgDataURL){
				var byteString = atob(imgDataURL.split(',')[1]);
				var orientaion = byteStringToOrientation(byteString);
				return orientaion;

				function byteStringToOrientation(img){
					var head = 0;
					var orientation;
					while (1){
						if (img.charCodeAt(head) == 255 & img.charCodeAt(head + 1) == 218) {break;}
						if (img.charCodeAt(head) == 255 & img.charCodeAt(head + 1) == 216) {
							head += 2;
						}
						else {
							var length = img.charCodeAt(head + 2) * 256 + img.charCodeAt(head + 3);
							var endPoint = head + length + 2;
							if (img.charCodeAt(head) == 255 & img.charCodeAt(head + 1) == 225) {
								var segment = img.slice(head, endPoint);
								var bigEndian = segment.charCodeAt(10) == 77;
								if (bigEndian) {
									var count = segment.charCodeAt(18) * 256 + segment.charCodeAt(19);
								} else {
									var count = segment.charCodeAt(18) + segment.charCodeAt(19) * 256;
								}
								for (var i=0;i<count;i++){
									var field = segment.slice(20 + 12 * i, 32 + 12 * i);
									if ((bigEndian && field.charCodeAt(1) == 18) || (!bigEndian && field.charCodeAt(0) == 18)) {
										orientation = bigEndian ? field.charCodeAt(9) : field.charCodeAt(8);
									}
								}
								break;
							}
							head = endPoint;
						}
						if (head > img.length){break;}
					}
					return orientation;
				}
			}

			// iPhoneのサブサンプリングを検出
			function detectSubsampling(img) {
				var iw = img.naturalWidth, ih = img.naturalHeight;
				if (iw * ih > 1024 * 1024) {
					var canvas = document.createElement('canvas');
					canvas.width = canvas.height = 1;
					var ctx = canvas.getContext('2d');
					ctx.drawImage(img, -iw + 1, 0);
					return ctx.getImageData(0, 0, 1, 1).data[3] === 0;
				} else {
					return false;
				}
			}

			// iPhoneの縦画像でひしゃげて表示される問題の回避
			function detectVerticalSquash(img, iw, ih) {
				var canvas = document.createElement('canvas');
				canvas.width = 1;
				canvas.height = ih;
				var ctx = canvas.getContext('2d');
				ctx.drawImage(img, 0, 0);
				var data = ctx.getImageData(0, 0, 1, ih).data;
				var sy = 0;
				var ey = ih;
				var py = ih;
				while (py > sy) {
					var alpha = data[(py - 1) * 4 + 3];
					if (alpha === 0) {
						ey = py;
					} else {
						sy = py;
					}
					py = (ey + sy) >> 1;
				}
				var ratio = (py / ih);
				return (ratio===0)?1:ratio;
			}

			function transformCoordinate(canvas, width, height, orientation) {
				if (orientation > 4) {
					canvas.width = height;
					canvas.height = width;
				} else {
					canvas.width = width;
					canvas.height = height;
				}
				var ctx = canvas.getContext('2d');
				switch (orientation) {
					case 2:
						// horizontal flip
						ctx.translate(width, 0);
						ctx.scale(-1, 1);
						break;
					case 3:
						// 180 rotate left
						ctx.translate(width, height);
						ctx.rotate(Math.PI);
						break;
					case 4:
						// vertical flip
						ctx.translate(0, height);
						ctx.scale(1, -1);
						break;
					case 5:
						// vertical flip + 90 rotate right
						ctx.rotate(0.5 * Math.PI);
						ctx.scale(1, -1);
						break;
					case 6:
						// 90 rotate right
						ctx.rotate(0.5 * Math.PI);
						ctx.translate(0, -height);
						break;
					case 7:
						// horizontal flip + 90 rotate right
						ctx.rotate(0.5 * Math.PI);
						ctx.translate(width, -height);
						ctx.scale(-1, 1);
						break;
					case 8:
						// 90 rotate left
						ctx.rotate(-0.5 * Math.PI);
						ctx.translate(-width, 0);
						break;
					default:
						break;
				}
			}
		};
	}

});
