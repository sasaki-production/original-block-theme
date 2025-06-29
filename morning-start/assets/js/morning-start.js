// 即時実行関数（定義と同時に実行される）
!(function () {
  // HTMLの <meta name="viewport"> タグを取得
  const viewport = document.querySelector('meta[name="viewport"]');

  // ビューポートの設定を切り替える関数
  function switchViewport() {
    // ウィンドウの外枠の幅が390pxを超えているかどうかで、viewportの値を変更
    const value =
      window.outerWidth > 390
        ? "width=device-width,initial-scale=1" // 通常のレスポンシブ表示
        : "width=390"; // 幅390pxで固定表示（小さい画面用）

    // 現在の viewport の値と異なる場合のみ、更新を行う
    if (viewport.getAttribute("content") !== value) {
      viewport.setAttribute("content", value); // 値を更新
    }
  }

  // 画面サイズが変わった時（リサイズ時）に switchViewport を実行
  addEventListener("resize", switchViewport, false);

  // ページ読み込み時にも一度実行して適切な viewport を設定
  switchViewport();
})();
