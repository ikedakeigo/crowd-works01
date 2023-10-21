<?php

/**
 * 未ログイン時はクッキー保存するLike機能
 */

/**
 * ajaxでのお気に入り追加削除
 */
function ajax_toggle_like() {
	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_options();

	// 追加時のメッセージ
	$add_message = ($dp_options['product_wishlist_message_add']) ? esc_html($dp_options['product_wishlist_message_add']) : __( 'Added to', 'tcd-ankle' );
	// 削除後のメッセージ
	$delete_message = ($dp_options['product_wishlist_message_remove']) ? esc_html($dp_options['product_wishlist_message_remove']) : __( 'Removed from', 'tcd-ankle' );

	$json = array(
		'result' => false
	);

	if ( ! isset( $_POST['post_id'] ) ) {
		$json['message'] = __( 'Invalid request.', 'tcd-ankle' );
	} else {
		$post_id = (int) $_POST['post_id'];
		$post_types = get_like_post_types();

		$user_id = get_current_user_id();
		

		if ( 0 < $post_id ) {
			$target_post = get_post( $post_id );
		}
		if ( empty( $target_post->post_status ) || ! $post_types ) {
			$json['message'] = __( 'Invalid request.', 'tcd-ankle' );
		} elseif ( 'publish' !== $target_post->post_status ) {
			$json['message'] = sprintf( __( 'Disable like in %s.', 'tcd-ankle' ), __( 'Not publish article', 'tcd-ankle' ) );
		} elseif ( ! in_array( $target_post->post_type, $post_types, true ) ) {
			$json['message'] = sprintf( __( 'Disable like in %s.', 'tcd-ankle' ), $target_post->post_type );
		} else {

			// お気に入り済みの場合、お気に入り削除
			if ( is_liked( $post_id, $user_id ) ) {
				$result = remove_like( $post_id, $user_id );
				if ( true === $result ) {
					$json['result'] = 'removed';
					$json['message'] = $delete_message;

					// お気に入りデータ数取得 get_like_count()でCOOKIEだと情報が古いので注意
					$user_likes = false;
					if ( $user_id ) {
						$user_likes = get_user_meta( $user_id, 'tcd_likes', true );
					} elseif ( ! empty( $_COOKIE['tcd_likes'] ) ) {
						$user_likes = explode( ',', $_COOKIE['tcd_likes'] );
						if ( $user_likes ) {
							array_pop( $user_likes );
						}
						$user_likes = implode( ',', $user_likes );
					}
					if ( $user_likes ) {
						$json['like_count'] = count( explode( ',', $user_likes ) );
					} else {
						$json['like_count'] = 0;
					}
				} elseif ( is_string( $result ) ) {
					$json['message'] = $result;
				} else {
					$json['message'] = __( 'Remove like error: ', 'tcd-ankle' ) . __( 'Failed to save the database.', 'tcd-ankle' );
				}

			// お気に入りしていない場合、お気に入り追加
			} else {
				$result = add_like( $post_id, $user_id );
				if ( true === $result ) {
					$json['result'] = 'added';
					$json['message'] = $add_message;

					// お気に入りデータ数取得 get_like_count()でCOOKIEだと情報が古いので注意
					$user_likes = false;
					if ( $user_id ) {
						$user_likes = get_user_meta( $user_id, 'tcd_likes', true );
					} elseif ( ! empty( $_COOKIE['tcd_likes'] ) ) {
						$user_likes = explode( ',', $_COOKIE['tcd_likes'] );
						$user_likes[] = -1;
						$user_likes = implode( ',', $user_likes );
					}
					if ( $user_likes ) {
						$json['like_count'] = count( explode( ',', $user_likes ) );
					} else {
						$json['like_count'] = 1;
					}
				} elseif ( is_string( $result ) ) {
					$json['message'] = $result;
				} else {
					$json['message'] = __( 'Add like error: ', 'tcd-ankle' ) . __( 'Failed to save the database.', 'tcd-ankle' );
				}
			}
		}
	}

	// JSON出力
	wp_send_json( $json );
	exit;
}
add_action( 'wp_ajax_toggle_like', 'ajax_toggle_like' );
add_action( 'wp_ajax_nopriv_toggle_like', 'ajax_toggle_like' );

/**
 * ajaxでのお気に入り追加 未使用
 */
function ajax_add_like() {
	$json = array(
		'result' => false
	);

	if ( ! isset( $_POST['post_id'] ) ) {
		$json['message'] = __( 'Invalid request.', 'tcd-ankle' );
	} else {
		$post_id = (int) $_POST['post_id'];
		$post_types = get_like_post_types();

		$user_id = get_current_user_id();
		

		if ( 0 < $post_id ) {
			$target_post = get_post( $post_id );
		}
		if ( empty( $target_post->post_status ) || ! $post_types ) {
			$json['message'] = __( 'Invalid request.', 'tcd-ankle' );
		} elseif ( 'publish' !== $target_post->post_status ) {
			$json['message'] = sprintf( __( 'Disable like in %s.', 'tcd-ankle' ), __( 'Not publish article', 'tcd-ankle' ) );
		} elseif ( ! in_array( $target_post->post_type, $post_types, true ) ) {
			$json['message'] = sprintf( __( 'Disable like in %s.', 'tcd-ankle' ), $target_post->post_type );
		} else {

			// お気に入り済みの場合
			if ( is_liked( $post_id, $user_id ) ) {
				$json['result'] = 'added';

			// お気に入りしていない場合、お気に入り追加
			} else {
				$result = add_like( $post_id, $user_id );
				if ( true === $result ) {
					$json['result'] = 'added';
				} elseif ( is_string( $result ) ) {
					$json['message'] = $result;
				} else {
					$json['message'] = __( 'Add like error: ', 'tcd-ankle' ) . __( 'Failed to save the database.', 'tcd-ankle' );
				}
			}
		}
	}

	// JSON出力
	wp_send_json( $json );
	exit;
}

/**
 * ajaxでのお気に入り削除
 */
function ajax_remove_like() {
	$json = array(
		'result' => false
	);

	if ( ! isset( $_POST['post_id'] ) ) {
		$json['message'] = __( 'Invalid request.', 'tcd-ankle' );
	} else {
		$post_id = (int) $_POST['post_id'];
		$post_types = get_like_post_types();

		$user_id = get_current_user_id();
		

		if ( 0 < $post_id ) {
			$target_post = get_post( $post_id );
		}
		if ( empty( $target_post->post_status ) || ! $post_types ) {
			$json['message'] = __( 'Invalid request.', 'tcd-ankle' );
		} elseif ( 'publish' !== $target_post->post_status ) {
			$json['message'] = sprintf( __( 'Disable like in %s.', 'tcd-ankle' ), __( 'Not publish article', 'tcd-ankle' ) );
		} elseif ( ! in_array( $target_post->post_type, $post_types, true ) ) {
			$json['message'] = sprintf( __( 'Disable like in %s.', 'tcd-ankle' ), $target_post->post_type );
		} else {

			// お気に入り済みの場合、お気に入り削除
			if ( is_liked( $post_id, $user_id ) ) {
				$result = remove_like( $post_id, $user_id );
				if ( true === $result ) {
					$json['result'] = 'removed';
				} elseif ( is_string( $result ) ) {
					$json['message'] = $result;
				} else {
					$json['message'] = __( 'Remove like error: ', 'tcd-ankle' ) . __( 'Failed to save the database.', 'tcd-ankle' );
				}

			// お気に入りしていない場合
			} else {
				$json['message'] = __( "You don't like this product.", 'tcd-ankle' );
			}
		}
	}

	// JSON出力
	wp_send_json( $json );
	exit;
}
add_action( 'wp_ajax_remove_like', 'ajax_remove_like' );
add_action( 'wp_ajax_nopriv_remove_like', 'ajax_remove_like' );

/**
 * お気に入り追加
 */
function add_like( $post_id, $user_id = null ) {
	if ( null === $user_id ) {
		
		$user_id = get_current_user_id();
		
	}

	// お気に入り済みの場合
	if ( is_liked( $post_id, $user_id ) ) {
		return 0;
	}

	$post_id = (int) $post_id;
	if ( 0 >= $post_id ) {
		return null;
	}

	$target_post = get_post( $post_id );
	if ( empty( $target_post->post_status ) || 'publish' !== $target_post->post_status ) {
		return null;
	}

	// お気に入りデータ取得
	if ( $user_id ) {
		$user_likes = get_user_meta( $user_id, 'tcd_likes', true );
	} elseif ( isset( $_COOKIE['tcd_likes'] ) ) {
		$user_likes = $_COOKIE['tcd_likes'];
	} else {
		$user_likes = false;
	}

	if ( $user_likes ) {
		$user_likes = array_filter( array_map( 'intval', explode( ',', $user_likes ) ) );

		// お気に入り配列キー取得
		$key = array_search( $post_id, $user_likes, true );

		// お気に入り済み場合
		if ( false !== $key ) {
			return false;
		}
	} else {
		$user_likes = array();
	}

	// 記事ID追加
	$user_likes[] = $post_id;
	$user_likes = array_unique( $user_likes );

	if ( $user_id ) {
		$result = update_user_meta( $user_id, 'tcd_likes', implode( ',', $user_likes ) );
	} else {
		$result = setcookie( 'tcd_likes', implode( ',', $user_likes ), time() + YEAR_IN_SECONDS * 5, COOKIEPATH, COOKIE_DOMAIN );
	}

	if ( $result ) {
		// ポストメタのお気に入り数を1増やす
		$post_likes_number = intval( get_post_meta( $post_id, 'tcd_likes', true ) );

		if ( 0 > $post_likes_number) {
			$post_likes_number = 0;
		}

		update_post_meta( $post_id, 'tcd_likes', $post_likes_number + 1 );

		return true;

	} elseif ( $user_id ) {
		return __( 'Add like error: ', 'tcd-ankle' ) . __( 'Failed to update user meta.', 'tcd-ankle' );
	} else {
		return __( 'Add like error: ', 'tcd-ankle' ) . __( 'Failed to save cookie.', 'tcd-ankle' );
	}
}

/**
 * お気に入り削除
 */
function remove_like( $post_id, $user_id = null ) {
	$post_id = (int) $post_id;
	if ( 0 >= $post_id ) {
		return null;
	}

	$target_post = get_post( $post_id );
	if ( empty( $target_post->post_status ) || 'publish' !== $target_post->post_status ) {
		return null;
	}

	if ( null === $user_id ) {
		
		$user_id = get_current_user_id();
		
	}

	// お気に入りデータ取得
	if ( $user_id ) {
		$user_likes = get_user_meta( $user_id, 'tcd_likes', true );
	} elseif ( isset( $_COOKIE['tcd_likes'] ) ) {
		$user_likes = $_COOKIE['tcd_likes'];
	} else {
		$user_likes = false;
	}

	// お気に入りデータあり
	if ( $user_likes ) {
		$user_likes = array_filter( array_map( 'intval', explode( ',', $user_likes ) ) );

		// お気に入り配列キー取得
		$key = array_search( $post_id, $user_likes, true );

		// お気に入り済み場合
		if ( false !== $key ) {
			unset( $user_likes[ $key ] );

			if ( $user_id ) {
				$result = update_user_meta( $user_id, 'tcd_likes', implode( ',', $user_likes ) );
			} else {
				$result = setcookie( 'tcd_likes', implode( ',', $user_likes ), time() + YEAR_IN_SECONDS * 5, COOKIEPATH, COOKIE_DOMAIN );
			}

			if ( $result ) {
				// ポストメタのお気に入り数を1減らす
				$post_likes_number = intval( get_post_meta( $post_id, 'tcd_likes', true ) ) - 1;
				if ( 0 > $post_likes_number) {
					$post_likes_number = 0;
				}
				update_post_meta( $post_id, 'tcd_likes', $post_likes_number );

				return true;

			} elseif ( $user_id ) {
					return __( 'Remove like error: ', 'tcd-ankle' ) . __( 'Failed to update user meta.', 'tcd-ankle' );
			} else {
				return __( 'Remove like error: ', 'tcd-ankle' ) . __( 'Failed to save cookie.', 'tcd-ankle' );
			}
		}
	}

	return false;
}

/**
 * お気に入り済みかを判別
 */
function is_liked( $post_id = null, $user_id = null ) {
	if ( null === $post_id ) {
		$post_id = get_the_ID();
	}
	$post_id = (int) $post_id;
	if ( 0 >= $post_id ) {
		return null;
	}

	$target_post = get_post( $post_id );
	if ( empty( $target_post->post_status ) || 'publish' !== $target_post->post_status ) {
		return null;
	}

	if ( null === $user_id ) {
		
		$user_id = get_current_user_id();
		
	}

	// お気に入りデータ取得
	if ( $user_id ) {
		$user_likes = get_user_meta( $user_id, 'tcd_likes', true );
	} elseif ( isset( $_COOKIE['tcd_likes'] ) ) {
		$user_likes = $_COOKIE['tcd_likes'];
	} else {
		$user_likes = false;
	}

	if ( $user_likes ) {
		$user_likes = array_map( 'intval', explode( ',', $user_likes ) );
		return in_array( $post_id, $user_likes, true );
	} else {
		return false;
	}
}

/**
 * お気に入り数取得
 */
function get_like_count( $user_id = null ) {
	if ( null === $user_id ) {
		
		$user_id = get_current_user_id();
		
	}

	// お気に入りデータ取得
	if ( $user_id ) {
		$user_likes = get_user_meta( $user_id, 'tcd_likes', true );
	} elseif ( isset( $_COOKIE['tcd_likes'] ) ) {
		$user_likes = $_COOKIE['tcd_likes'];
	} else {
		$user_likes = false;
	}

	if ( $user_likes ) {
		return count( explode( ',', $user_likes ) );
	} else {
		return 0;
	}
}

/**
 * お気に入り投稿タイプ取得
 */
function get_like_post_types() {
	$post_types = array();

	if ( is_woocommerce_active() ) {
		$post_types[] = 'product';
	}

	return apply_filters( 'get_like_post_types', $post_types );
}

/**
 * ユーザーのお気に入り記事一覧配列を取得
 *
 * @param int    $user_id    ユーザーID（未指定時はログインユーザー）
 * @param string $query_args WP_Queryの引数指定
 * @param string $output     出力形式 [ ''（WP_Query以外） | WP_Query ]
 *
 * @return WP_Query|array
 */
function get_user_liked_posts( $user_id = null, $query_args = array(), $output = 'WP_Query' ) {
	$query_args_defaults = array(
		'ignore_sticky_posts' => 1,
		'post_type' => get_like_post_types()
	);
	$query_args = wp_parse_args( (array) $query_args, $query_args_defaults );

	$output = strtolower( $output );

	if ( null === $user_id ) {

		$user_id = get_current_user_id();
	
	}

	// お気に入りデータ取得
	if ( $user_id ) {
		$user_likes = get_user_meta( $user_id, 'tcd_likes', true );
	} elseif ( isset( $_COOKIE['tcd_likes'] ) ) {
		$user_likes = $_COOKIE['tcd_likes'];
	} else {
		$user_likes = false;
	}

	if ( $user_likes ) {
		$user_likes = array_map( 'intval', explode( ',', $user_likes ) );
	} else {
		if ( 'wp_query' === $output ) {
			$_wp_query = new WP_Query();
			return $_wp_query;
		} else {
			return array();
		}
	}

	// お気に入り追加した順の逆
	$query_args['post__in'] = array_reverse( $user_likes );
	$query_args['orderby'] = 'post__in';
	$_wp_query = new WP_Query( $query_args );

	if ( 'wp_query' === $output ) {
		return $_wp_query;
	} else {
		return (array) $_wp_query->posts;
	}
}

/**
 * 記事保存時にtcd_likesメタが空なら0をセット
 */
function save_post_likes_zero( $post_id, $post = null ) {
	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}

	if ( ! empty( $post->post_type ) && in_array( $post->post_type, get_like_post_types() ) && '' === get_post_meta( $post_id, 'tcd_likes', true ) ) {
		update_post_meta( $post_id, 'tcd_likes', 0 );
	}
}
add_action( 'save_post', 'save_post_likes_zero', 10, 2 );


/**
 * ログインした時にクッキー保存されていればマージする
 */
function convert_like_cookie_to_usermeta( $user_login = null, $user = null ) {
	if ( empty( $_COOKIE['tcd_likes'] ) ) {
		return false;
	}

	if ( ! empty( $user->ID ) ) {
		$user_id = $user->ID;
	} else {
		$user_id = null;
	}
	if ( ! $user_id ) {
		return false;
	}

	$cookie_likes = array_map( 'intval', explode( ',', $_COOKIE['tcd_likes'] ) );
	if ( ! $cookie_likes ) {
		return false;
	}

	// お気に入りデータ取得
	if ( $user_id ) {
		$user_likes = get_user_meta( $user_id, 'tcd_likes', true );
	} else {
		$user_likes = array();
	}

	if ( $user_likes ) {
		$user_likes = array_map( 'intval', explode( ',', $user_likes ) );
	} else {
		$user_likes = array();
	}

	$diff = array_diff( $cookie_likes, $user_likes );

	if ( $diff ) {
		$user_likes = array_merge( $user_likes, $diff );

		$result = update_user_meta( $user_id, 'tcd_likes', implode( ',', $user_likes ) );
		if ( $result ) {
			setcookie( 'tcd_likes', '', time() - 3600, COOKIEPATH, COOKIE_DOMAIN );

			return true;
		}
	}
}
add_action( 'wp_login', 'convert_like_cookie_to_usermeta', 10, 2 );
add_action( 'usces_action_after_login', 'convert_like_cookie_to_usermeta', 10 );
