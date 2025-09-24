<h1>確認方法</h1><br>
【確認方法】<br>
①フォルダを解凍<br>
②確認方法<br>
<b>XAMPPの場合</b>　
<ol>
  <li>C:\xampp\htdocs\sourcepod_homework　のようにXAMPPのパスが通っているところにフォルダを置く</li>
  <li>XAMPPのApacheの起動</li>
  <li>ブラウザで　http://localhost/sourcepod_homework/(ファイル名)　を入力</li>
</ol>
【ファイルの説明】<br>
Q1に対するファイル：　q1.php <br>
Q2に対するファイル：　q2.php  <br>
Q3に対するファイル：　q3.php  <br>
Q4に対するファイル：　q4.php  <br>

<b>Dockerを使用する場合※docker desktopがインストールされている前提</b>
<ol>
  <li>ローカルの環境にフォルダ（marutani等）を作成 例：C:\Users\yui_m\doc\marutani</li>
  <li>windowsの場合powershellでパスを作成したフォルダに移動 例：C:\Users\yui_m が今のディレクトリの場合、cd doc\marutani <br>
    その後、powershellでgit clone　例：git clone https://github.com/yuiMarutani/sourcepod_homework.git
  </li>
  <li>git pull origin master を実行（コードの取得）</li>
  <li>gitで取得したファイルがフォルダに入っているフォルダまで移動。例：cd sourcepod_homeworkに移動する</li>
  <li>docker desktopを起動</li>
  <li>dockerイメージの取得とコンテナの作成　例：docker-compose up -d --build</li>
  <li>コンテナが立ち上がったらブラウザに　localhost:8080/q1.php のように入力</li>
  <li>終了、見終わった場合docker desktop でコンテナをstop</li>
  <li>コンテナを立ち上げる場合もdocker desktopで立ち上げる</li>
</ol>
<h1>使用ファイルの説明</h1>
Account.php: Q4で使用。Q4各問に対してAccountクラスのメソッドを作成。<br>
Canvas.php: Q3のポリゴンの図を作成、pngイメージの作成。<br>
ScaleFive.php：Q1の5点単位のグラフを表すクラス。<br>
ScaleTen.php: Q1の10点単位のグラフを表すクラス。<br>
ScaleFiveQ2.php：Q2の5点単位のグラフを表すクラス。<br>
ScaleTenQ2.php: Q2の10点単位のグラフを表すクラス。<br>

<h1>開発環境</h1><br>
純正PHP×Jpgraph×XAMPP

<h1>ライセンスについて</h1>
このプロジェクトでは以下のライブラリを使用しています：

- [JpGraph](https://jpgraph.net/)  
  グラフ描画ライブラリ。ライセンスに従って使用しています。
  本来はJpgraphライブラリのgit上にアップはNGですが、Jpgraphダウンロードからセットアップ等結構こつが必要のため
  今回確認のためだけにあらかじめ含めてあります。（商用は有料）
