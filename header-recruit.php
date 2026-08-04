<!DOCTYPE HTML>
<html lang="ja"><head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta charset="utf-8">

<?php
	$uri = rtrim($_SERVER['REQUEST_URI'], '/');
	$recruit = "/recruit";
	$about = "/recruit/about";
	$careerplan = "/recruit/careerplan";
	$workstyle = "/recruit/workstyle";
	$people = "/recruit/people";
	$hirose = "/recruit/people/hirose";
	$kohama = "/recruit/people/kohama";
	$matsuno = "/recruit/people/matsuno";
	$sugao = "/recruit/people/sugao";
	$jobposting = "/recruit/jobposting";
	$entry = "/recruit/entry";
	$entry_conf = "/recruit/entry/conf.php";
	$entry_regist = "/recruit/entry/regist.php";
	$title = "";
	$description = "";
	$keywords = "";
?>

<?php if($uri == $recruit){
	$title = "シティクラフト採用サイト｜名古屋のIT基盤に強い革新型エンジニアへ";
	$description = "シティクラフトは、名古屋を拠点にIT基盤・システム開発の仕組みを提供しています。「最高のエンジニア集団」をつくるために、技術力・提案力・人間力を育む環境で、これからの時代を切り拓くエンジニアを募集しています。";
	$keywords = "シティクラフト,システム開発,IT基盤,システムエンジニア,システムアーキテクチャ設計,フレームワーク開発、クラウド基盤構築、セキュリティコンサル,採用情報";
}elseif($uri == $about){
	$title = "シティクラフトについて｜名古屋のIT基盤・クラウド構築に強いエンジニア集団";
	$description = "シティクラフトは、システムアーキテクチャ設計からフレームワーク開発、クラウド基盤構築、セキュリティコンサルまで、IT基盤と仕組みを提供しています。未経験の方でも大歓迎。挑戦を楽しめる人にこそ、チャンスのある職場です。";
	$keywords = "シティクラフト,システム開発,IT基盤,システムエンジニア,システムアーキテクチャ設計,フレームワーク開発、クラウド基盤構築、セキュリティコンサル,採用情報";
}elseif($uri == $careerplan){
	$title = "シティクラフトで育むキャリアプラン｜名古屋でIT基盤開発に強いエンジニアへ";
	$description = "シティクラフトでは、常に市場価値の高い技術、分野で挑戦出来る環境があります。アプリの開発、フレームワーク開発・クラウド基盤の構築、アーキテクチャ設計、チームリーダー、マネージャーと、実務を通じた成長と、計画的なキャリア形成を支援します。";
	$keywords = "シティクラフト,システム開発,IT基盤,システムエンジニア,システムアーキテクチャ設計,フレームワーク開発、クラウド基盤構築、セキュリティコンサル,採用情報,キャリアプラン";
}elseif($uri == $workstyle){
	$title = "シティクラフトの働き方・福利厚生｜名古屋でIT基盤開発に強いエンジニアへ";
	$description = "シティクラフトでは、リモートワーク、フレックスタイム制など、社員一人ひとりが安心して、自分らしく働き続けられる環境づくりに取り組んでいます。人材育成を支援する制度や、健康・生活をサポートする福利厚生で、働きやすさと成長の両立を実現しています。";
	$keywords = "シティクラフト,システム開発,IT基盤,システムエンジニア,システムアーキテクチャ設計,フレームワーク開発、クラウド基盤構築、セキュリティコンサル,採用情報,働き方,福利厚生";
}elseif($uri == $people){
	$title = "シティクラフト社員の声｜名古屋のIT基盤・クラウド構築に強いエンジニア集団";
	$description = "シティクラフトで実際に働く先輩たちのリアルな声を集めました。 仕事のやりがい、これからの目標など、それぞれのストーリーから会社の雰囲気や価値観を感じてみてください。あなたの未来を重ねてみたくなるヒントが、きっと見つかるはずです。";
	$keywords = "シティクラフト,システム開発,IT基盤,システムエンジニア,システムアーキテクチャ設計,フレームワーク開発、クラウド基盤構築、セキュリティコンサル,採用情報,社員の声";
}elseif($uri == $hirose){
	$title = "学び続けるエンジニアがチームを導く未来をつくる｜シティクラフトの社員の声";
	$description = "シティクラフトで活躍する先輩社員のインタビュー。エンジニアとしての市場価値を高め、より責任のある仕事に挑戦することができると考え、入社。技術力と経験を活かし、大規模で重要なプロジェクトの中心的な役割を担うエンジニアの声をご紹介します。";
	$keywords = "シティクラフト,システム開発,IT基盤,システムエンジニア,システムアーキテクチャ設計,フレームワーク開発、クラウド基盤構築、セキュリティコンサル,採用情報,社員の声";
}elseif($uri == $kohama){
	$title = "人を大切にする環境でエンジニアとしての本質を追求｜シティクラフトの社員の声";
	$description = "シティクラフトで活躍する先輩社員のインタビュー。スカウト型の求人を通じて入社を決意し、設計からクラウドまで幅広く挑戦。新しいことにチャレンジしやすい環境と、支えてくれる仲間の存在があるからこそ、前向きに成長し続けるエンジニアの声をご紹介します。";
	$keywords = "シティクラフト,システム開発,IT基盤,システムエンジニア,システムアーキテクチャ設計,フレームワーク開発、クラウド基盤構築、セキュリティコンサル,採用情報,社員の声";
}elseif($uri == $matsuno){
	$title = "やりたいことに素直になれる会社です｜シティクラフトの社員の声";
	$description = "シティクラフトで活躍する先輩社員のインタビュー。「子育てとの両立」と「エンジニアとしての更なる挑戦」、この二つを諦めずに追求できる場所として入社を決意。マネージャーとしてチームを率い、お客様の多種多様な課題に応えるエンジニアをご紹介します。";
	$keywords = "シティクラフト,システム開発,IT基盤,システムエンジニア,システムアーキテクチャ設計,フレームワーク開発、クラウド基盤構築、セキュリティコンサル,採用情報,社員の声";
}elseif($uri == $sugao){
	$title = "興味から始まった挑戦が毎日を面白くしてくれる｜シティクラフトの社員の声";
	$description = "シティクラフトで活躍する先輩社員のインタビュー。フレームワークなどの基盤部分からソフトウェア開発に携われること、幅広い業務に挑戦できる環境に魅力を感じ入社。「より多くのシステム開発の課題を解決できるエンジニア」を目指す社員をご紹介します。";
	$keywords = "シティクラフト,システム開発,IT基盤,システムエンジニア,システムアーキテクチャ設計,フレームワーク開発、クラウド基盤構築、セキュリティコンサル,採用情報,社員の声";
}elseif($uri == $jobposting){
	$title = "シティクラフトの募集要項｜名古屋でIT基盤開発に強いエンジニアへ";
	$description = "シティクラフトでは、プログラム・システムエンジニアとしてこれからの時代を切り拓く、革新型エンジニアを一緒に目指す仲間を募集しています。未経験からキャリア採用まで、一人ひとりが輝ける環境を整えています。まずは、あなたの働き方や今後のビジョンをお聞かせください。";
	$keywords = "シティクラフト,システム開発,IT基盤,システムエンジニア,システムアーキテクチャ設計,フレームワーク開発、クラウド基盤構築、セキュリティコンサル,採用情報,募集要項";
}elseif($uri == $entry){
	$title = "エントリーフォーム｜名古屋のIT基盤開発ならシティクラフト";
	$description = "シティクラフトへのエントリーはこちら。システム開発に関心があり、成長意欲の高い方なら未経験でも大歓迎です。プログラム・システムエンジニアとして、今だけではなく、これからを見据えたキャリアをここで一緒に育てませんか？あなたの挑戦をお待ちしています。";
	$keywords = "シティクラフト,システム開発,IT基盤,システムエンジニア,システムアーキテクチャ設計,フレームワーク開発、クラウド基盤構築、セキュリティコンサル,採用情報,エントリーフォーム";
}elseif($uri == $entry_conf){
	$title = "エントリーフォーム確認｜名古屋のIT基盤開発ならシティクラフト";
	$description = "シティクラフトへのエントリーはこちら。システム開発に関心があり、成長意欲の高い方なら未経験でも大歓迎です。プログラム・システムエンジニアとして、今だけではなく、これからを見据えたキャリアをここで一緒に育てませんか？あなたの挑戦をお待ちしています。";
	$keywords = "シティクラフト,システム開発,IT基盤,システムエンジニア,システムアーキテクチャ設計,フレームワーク開発、クラウド基盤構築、セキュリティコンサル,採用情報,エントリーフォーム";
}elseif($uri == $entry_regist){
	$title = "エントリーフォーム送信完了｜名古屋のIT基盤開発ならシティクラフト";
	$description = "シティクラフトへのエントリーはこちら。システム開発に関心があり、成長意欲の高い方なら未経験でも大歓迎です。プログラム・システムエンジニアとして、今だけではなく、これからを見据えたキャリアをここで一緒に育てませんか？あなたの挑戦をお待ちしています。";
	$keywords = "シティクラフト,システム開発,IT基盤,システムエンジニア,システムアーキテクチャ設計,フレームワーク開発、クラウド基盤構築、セキュリティコンサル,採用情報,エントリーフォーム";
}else{
	$title = "シティクラフト採用";
	$description = "";
	$keywords = "";
} ?>

<title><?php echo $title; ?></title>
<meta name="Description" content="<?php echo $description; ?>">
<meta name="Keywords" content="<?php echo $keywords; ?>">

<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="format-detection" content="telephone=no">


<link href="/common/css/base.css" rel="stylesheet" type="text/css" />
<link href="/common/css/layout-recruit.css?<?php echo date('Ymd-Hi'); ?>" rel="stylesheet" type="text/css" />
<script src="/common/js/jquery.min.js"></script>
<script src="/common/js/common-recruit.js"></script>
<link href="/common/js/swiper/swiper.min.css" rel="stylesheet" type="text/css" />
<script src="/common/js/swiper/swiper-bundle.min.js"></script>


<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://use.typekit.net/xjp1fbz.css">

</head>

<body id="<?php if($_SERVER['REQUEST_URI']=="/recruit" ){echo "index";}else{echo "subPage";} ?>">
<p id="pagetop"></p>

<header id="header">
  <div class="headerWrap d-flex jc-between maxWidth">
    <p class="hLogo"><a href="/recruit"><img src="/common/img/logo_black02.svg" alt="株式会社シティクラフト"/><span class="fontEn">City Craft Co.Ltd<br><span class="big">RECRUIT</span></span></a></p>
    <nav class="hNav d-flex">
      <ul class="d-flex">
        <li><a href="/recruit/about">「シティクラフト」について</a></li>
        <li><a href="/recruit/careerplan">キャリアプラン・制度</a></li>
        <li><a href="/recruit/workstyle">働き方・福利厚生</a></li>
        <li><a href="/recruit/people">人を知る</a></li>
        <li><a href="/recruit/jobposting">募集要項</a></li>
      </ul>
      <p class="btn fontEn fontYe"><a href="/recruit/entry">ENTRY</a></p>
    </nav>
  </div>
</header>
<div class="menuIconWrap">
  <div class="menuIcon"><span></span><span></span><span></span></div>
</div>
<div id="nav" class="spMenu onlysp">
  <p class="spLogo"><a href="/recruit"><img src="/common/img/logo_black02.svg" alt="株式会社シティクラフト"/><span class="fontEn">City Craft Co.Ltd<br><span class="big">RECRUIT</span></span></a></p>
  <nav class="spNav">
    <ul>
      <li><a href="/recruit">トップ</a></li>
      <li><a href="/recruit/about">「シティクラフト」について</a></li>
      <li><a href="/recruit/careerplan">キャリアプラン・制度</a></li>
      <li><a href="/recruit/workstyle">働き方・福利厚生</a></li>
      <li><a href="/recruit/people">人を知る</a></li>
      <li><a href="/recruit/jobposting">募集要項</a></li>
      <li><a href="/recruit/entry">エントリーフォーム</a></li>
    </ul>
  </nav>
  <a href="/" class="corporateBtn d-flex">
    <figure class="img"><img src="/common/img/logo_black02.svg" alt="株式会社シティクラフト"/></figure>
    <p class="enJaTtl"><span class="fontEn">CORPORATE<br>SITE</span>コーポレートサイト</p>
  </a>
</div>