<?php
// ブロックエディタ用のCSSファイルを読み込む関数
function my_block_assets()
{

    global $post;
    if ($post && $post->post_type === 'post') {

        // テーマ内のCSSファイル（/assets/css/style.css）を読み込む
        wp_enqueue_style(
            'post', // このCSSのハンドル名（識別子）。他と重ならない任意の名前をつける
            get_template_directory_uri() . '/assets/css/post.css', // テーマ内のCSSファイルのURLを指定
            array(), // 依存するスタイルがあればここに配列で指定（今回はなし）
            filemtime(get_theme_file_path('/assets/css/post.css')), // ファイルの更新日時をバージョンとして指定 → キャッシュ対策になる
            'all' // メディアタイプ（通常は 'all' でOK）
        );
    }

    // テーマ内のCSSファイル（/assets/css/style.css）を読み込む
    wp_enqueue_style(
        'morning-start', // このCSSのハンドル名（識別子）。他と重ならない任意の名前をつける
        get_template_directory_uri() . '/assets/css/style.css', // テーマ内のCSSファイルのURLを指定
        array(), // 依存するスタイルがあればここに配列で指定（今回はなし）
        filemtime(get_theme_file_path('/assets/css/style.css')), // ファイルの更新日時をバージョンとして指定 → キャッシュ対策になる
        'all' // メディアタイプ（通常は 'all' でOK）
    );
}
// ブロックエディタ用のCSSを読み込むタイミングで上記の関数を実行
add_action('enqueue_block_assets', 'my_block_assets');

// ボタンブロックにカスタムスタイル「矢印付き(Default)」を追加する関数
function add_default_arrow_button()
{
    // WordPressの標準ボタンブロック（core/button）に新しいスタイルを登録
    register_block_style(
        'core/button', // 対象ブロック（ここでは標準のボタンブロック）
        array(
            'name'  => 'default-arrow-button', // スタイルの識別子（CSSクラスに使用される）
            'label' => '矢印付き(Default)'     // エディタ上で表示されるスタイル名
        )
    );
}
// WordPressの初期化処理（init）時に、上記の関数を実行
add_action('init', 'add_default_arrow_button');

// ボタンブロックにカスタムスタイル「矢印付きPriority)」を追加する関数
function add_priority_arrow_button()
{
    // WordPressの標準ボタンブロック（core/button）に新しいスタイルを登録
    register_block_style(
        'core/button', // 対象ブロック（ここでは標準のボタンブロック）
        array(
            'name'  => 'priority-arrow-button', // スタイルの識別子（CSSクラスに使用される）
            'label' => '矢印付き(Priority)'     // エディタ上で表示されるスタイル名
        )
    );
}
// WordPressの初期化処理（init）時に、上記の関数を実行
add_action('init', 'add_priority_arrow_button');


// ボタンブロックにカスタムスタイル「矢印付きPriority)」を追加する関数
function add_category_badge()
{
    // WordPressの標準ボタンブロック（core/post-tames）に新しいスタイルを登録
    register_block_style(
        'core/post-terms', // 対象ブロック（ここでは標準のボタンブロック）
        array(
            'name'  => 'category-badge', // スタイルの識別子（CSSクラスに使用される）
            'label' => 'バッチ'     // エディタ上で表示されるスタイル名
        )
    );
}
// WordPressの初期化処理（init）時に、上記の関数を実行
add_action('init', 'add_category_badge');


// JavaScriptファイルを読み込むための関数を定義
function my_scripts()
{

    // wp_enqueue_script 関数を使って JavaScript ファイルを登録・読み込み
    wp_enqueue_script(
        'morning-start', // スクリプトのハンドル名（識別用の名前）
        get_template_directory_uri() . '/assets/js/morning-start.js', // スクリプトのファイルパス（テーマフォルダ内の指定ファイル）
        array(), // このスクリプトが依存するスクリプト（今回は依存なし）
        '1.0.0', // バージョン番号（キャッシュ対策に使える）
        true // フッターで読み込むかどうか（trueで</body>直前に読み込み）
    );
}

// 'wp_enqueue_scripts' アクションフックに 'my_scripts' 関数を登録
// → テーマがスクリプトやスタイルを読み込むタイミングで実行される
add_action('wp_enqueue_scripts', 'my_scripts');


// imgタグに自動で付与される sizes 属性を無効にする（WordPress 6.1以降）
// レスポンシブ画像の自動処理を制御したい場合に使用
add_filter('wp_img_tag_add_auto_sizes', '__return_false');


// 投稿に「サブタイトル（sub-title）」というカスタムメタフィールドを追加する
function add_sub_title_meta() {
    register_meta(
        'post', // 投稿タイプ（'post'）に対してメタ情報を登録
        'sub-title', // メタフィールドのキー名（例：sub-title）
        array(
            'show_in_rest' => true,  // REST API で使用可能にする（Gutenberg対応）
            'single'       => true,  // 単一の値を扱う（true = 値は1つ、false = 配列）
            'default'      => '',    // 初期値（空文字）
            // 'type' => 'string' を追加するとさらに厳密なバリデーションが可能
        )
    );
}
// WordPress 初期化時（init）にフックしてメタフィールドを登録
add_action('init', 'add_sub_title_meta');