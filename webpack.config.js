const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = {
  //エントリポイント（デフォルトと同じなので省略可）
  entry: "./assets/scss/styles.scss",
  //出力先（デフォルトと同じなので省略可）
  output: {
    path: path.resolve(__dirname, "./assets/css"),
    clean: true,
  },
  module: {
    rules: [
      //SASS 及び CSS 用のローダー
      {
        //拡張子 .scss、.sass、css を対象
        test: /\.(scss|sass|css)$/i,
        // 使用するローダーの指定（後ろから順番に適用される）
        use: [
          //CSS を別ファイルとして出力するプラグインのローダー
          MiniCssExtractPlugin.loader,
          {
            loader: "css-loader",
            options: {
              // postcss-loader と sass-loader の場合は2を指定
              importLoaders: 2,
              // 0 => no loaders (default);
              // 1 => postcss-loader;
              // 2 => postcss-loader, sass-loader
            },
          },
          // PostCSS の設定
          {
            loader: "postcss-loader",
            options: {
              postcssOptions: {
                plugins: [
                  [
                    "postcss-preset-env",
                    {
                      //必要に応じてオプションを指定
                      //stage: 0,
                      browsers: "last 2 versions",
                      //autoprefixer のオプション
                      autoprefixer: { grid: true },
                    },
                  ],
                ],
              },
            },
          },
          {
            loader: "sass-loader",
            options: {
              sassOptions: {
                outputStyle: "compressed",
              },
            },
          },
        ],
      },
    ],
  },
  //プラグインの設定
  plugins: [
    new MiniCssExtractPlugin({
      // 抽出する CSS のファイル名
      filename: "style.css",
    }),
  ],
  //source-map タイプのソースマップを出力
  devtool: "source-map",
  // node_modules を監視（watch）対象から除外
  watchOptions: {
    ignored: /node_modules/, //正規表現で指定
  },
};
