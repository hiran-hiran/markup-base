<?php
// ログイン画面のロゴ変更
// function login_logo() {
//   echo '<style type="text/css">.login h1 a {background-image: url(/assets/img/common/logo.svg);width:240px;height:100px;background-size:contain;background-position: center;}</style>';
// }
// add_action('login_head', 'login_logo');

// ログイン画面のロゴURL
// function custom_login_logo_url() {
//   return get_bloginfo('url');
// }
// add_filter('login_headerurl', 'custom_login_logo_url');

/*【管理画面】投稿メニューを非表示 */
function remove_menus() {
  global $menu;
  remove_menu_page('edit.php');
  remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'remove_menus');


// utilty
function h($str) {
  return htmlspecialchars($str, ENT_QUOTES);
}

function pre($e) {
  echo "<pre>";
  print_r($e);
  echo "</pre>";
}

function get_current_link() {
  return (is_ssl() ? 'https' : 'http') . '://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
}

function overflowText($text, $limit) {
  if (mb_strlen($text) > $limit) {
    return mb_substr($text, 0, $limit, 'UTF-8') . '...';
  } else {
    return $text;
  }
}


function create_post_type_mv() {
  register_post_type(
    "mv",
    array(
      "labels" => array(
        "name" => "メイン画像",
        "singular_name" => "メイン画像",
        "add_new" => "メイン画像を追加",
        "add_new_item" => "メイン画像を追加",
        "edit_item" => "メイン画像を編集",
        "all_items" => "メイン画像一覧",
        "view_item" => "メイン画像を表示",
      ),
      "public" => true,
      "supports" => array("title", "editor", "tag", "thumbnail"),
      "has_archive" => true,
      'menu_position' => 5,
      "rewrite" => array("slug" => "mv")
    )
  );
}
add_action("init", "create_post_type_mv");
add_action( 'init', function() { 
	remove_post_type_support('mv', 'editor'); 
}, 99);


function create_post_type() {
  register_post_type(
    "news",
    array(
      "labels" => array(
        "name" => "お知らせ",
        "singular_name" => "お知らせ",
        "add_new" => "お知らせを追加",
        "add_new_item" => "お知らせを追加",
        "edit_item" => "お知らせを編集",
        "all_items" => "お知らせ一覧",
        "view_item" => "お知らせを表示",
      ),
      "public" => true,
      "supports" => array("title", "editor", "tag", "thumbnail"),
      "has_archive" => true,
      'menu_position' => 5,
      "rewrite" => array("slug" => "news")
    )
  );
}
add_action("init", "create_post_type");




function add_prev_posts_link_class() {
  return 'class="prev"';
}
add_filter( 'previous_posts_link_attributes', 'add_prev_posts_link_class' );

function add_next_posts_link_class() {
  return 'class="next"';
}
add_filter( 'next_posts_link_attributes', 'add_next_posts_link_class' );



function add_prev_post_link_class($output) {
  return str_replace('<a href=', '<a class="prev" href=', $output);
}
add_filter( 'previous_post_link', 'add_prev_post_link_class' );

function add_next_post_link_class($output) {
  return str_replace('<a href=', '<a class="next" href=', $output);
}
add_filter( 'next_post_link', 'add_next_post_link_class' );

add_filter('wpcf7_validate_configuration', '__return_false');

add_filter('wpcf7_validate_email', 'wpcf7_validate_email_filter_confrim', 11, 2);
add_filter('wpcf7_validate_email*', 'wpcf7_validate_email_filter_confrim', 11, 2);
function wpcf7_validate_email_filter_confrim($result, $tag) {
  $type = $tag['type'];
  $name = $tag['name'];
  if ('email' == $type || 'email*' == $type) {
    if (preg_match('/(.*)_confirm$/', $name, $matches)) { //確認用メルアド入力フォーム名を ○○○_confirm としています。
      $target_name = $matches[1];
      $posted_value = trim((string) $_POST[$name]); //前後空白の削除
      $posted_target_value = trim((string) $_POST[$target_name]); //前後空白の削除
      if ($posted_value != $posted_target_value) {
        $result->invalidate($tag, "確認用のメールアドレスが一致していません");
      }
    }
  }
  return $result;
}
