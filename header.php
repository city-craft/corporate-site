<!DOCTYPE HTML>
<html lang="ja"><head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta charset="utf-8">

<?php
	$uri = rtrim($_SERVER['REQUEST_URI'], '/');
  $company = "/company";
	$message = "/company/message";
	$overview = "/company/overview";
	$business = "/business";
	$access = "/access";
	$policies = "/policies";
	$contact = "/contact";
	$contact_conf = "/contact/conf.php";
	$contact_regist = "/contact/regist.php";
	$title = "";
	$description = "";
	$keywords = "";
?>

<?php if($uri == ""){
	$title = "名古屋のIT基盤・クラウド構築に強いエンジニア集団｜株式会社シティクラフト";
	$description = "シティクラフトは、システムアーキテクチャ設計からフレームワーク開発、クラウド基盤構築、セキュリティコンサルまで、IT基盤と仕組みを提供しています。確かな技術力と将来を見据えた提案力で、持続可能な成長と確かな価値を創出しています。";
	$keywords = "シティクラフト,システム開発,IT基盤,システムエンジニア,システムアーキテクチャ設計,フレームワーク開発、クラウド基盤構築、セキュリティコンサル,";
}elseif($uri == $company){
	$title = "シティクラフトの企業情報｜名古屋のIT基盤・クラウド構築に強いエンジニア集団";
	$description = "シティクラフトの企業情報ページです。名古屋を拠点にシステムアーキテクチャ設計、フレームワーク開発、クラウド基盤構築、セキュリティコンサルを通じて、エンジニアの現場を支える“仕掛け”をつくる会社です。代表メッセージ、会社概要、沿革などご覧いただけます。";
	$keywords = "シティクラフト,システム開発,IT基盤,システムエンジニア,システムアーキテクチャ設計,フレームワーク開発、クラウド基盤構築、セキュリティコンサル,企業情報";
}elseif($uri == $message){
	$title = "代表メッセージ｜名古屋のIT基盤開発・クラウド構築ならシティクラフト";
	$description = "シティクラフトは、高度化するソフトウェア技術や生成AI時代の中で、現場の「困った」に真正面から向き合い、それを解決へ導くためのシステム開発基盤を提供しています。技術と人間力を融合させ、「本当に価値のあるもの」を創り出してまいります。";
	$keywords = "シティクラフト,システム開発,IT基盤,システムエンジニア,システムアーキテクチャ設計,フレームワーク開発、クラウド基盤構築、セキュリティコンサル,代表メッセージ";
}elseif($uri == $overview){
	$title = "シティクラフトの企業情報｜名古屋のIT基盤・クラウド構築に強いエンジニア集団";
	$description = "名古屋を拠点に、システムエンジニアリングサービス、ソフトウェアの企画、設計、開発、保守を行っている会社です。ISO/IEC 27001の認証を取得し、より一層の情報セキュリティ管理の強化を図り、安心かつ信頼いただけるサービスの提供に努めてまいります。";
	$keywords = "シティクラフト,システム開発,IT基盤,システムエンジニア,システムアーキテクチャ設計,フレームワーク開発、クラウド基盤構築、セキュリティコンサル,会社概要";
}elseif($uri == $business){
	$title = "シティクラフトの事業内容｜名古屋のIT基盤・クラウド構築に強いエンジニア集団";
	$description = "シティクラフトは、システムアーキテクチャ設計、フレームワーク開発、クラウド基盤構築、セキュリティコンサルティングを通じて、使いやすく拡張性のあるIT基盤を提供。エンジニアや利用者の視点に立ち、変化に強く持続可能な仕組みを設計・支援します。";
	$keywords = "シティクラフト,システム開発,IT基盤,システムエンジニア,システムアーキテクチャ設計,フレームワーク開発、クラウド基盤構築、セキュリティコンサル,事業内容";
}elseif($uri == $access){
	$title = "シティクラフトへのアクセス｜名古屋のIT基盤に強いエンジニア集団";
	$description = "シティクラフトのアクセスページです。会社へお越しになる際は、こちらをご覧ください。中日ビルのオフィスフロアへの入館方法を、写真付きで詳しくご案内しています。13階へのアクセスには専用エレベーターをご利用ください。";
	$keywords = "シティクラフト,システム開発,IT基盤,システムエンジニア,システムアーキテクチャ設計,フレームワーク開発、クラウド基盤構築、セキュリティコンサル,アクセス,中日ビル";
}elseif($uri == $policies){
	$title = "各種ポリシー｜名古屋のIT基盤開発・クラウド構築ならシティクラフト";
	$description = "シティクラフトの各種ポリシーページです。個人情報保護方針、情報セキュリティ基本方針、環境方針を掲載。個人情報の適切な管理・利用、情報資産の保護、環境保全への継続的な取り組みなど、持続可能で信頼性の高い企業活動を実践しています。";
	$keywords = "シティクラフト,システム開発,IT基盤,システムエンジニア,システムアーキテクチャ設計,フレームワーク開発、クラウド基盤構築、セキュリティコンサル,各種ポリシー";
}elseif($uri == $contact){
	$title = "お問い合わせ｜名古屋のIT基盤開発・クラウド構築ならシティクラフト";
	$description = "シティクラフトへのお問い合わせはこちらから。システムアーキテクチャ設計、フレームワーク開発、クラウド基盤構築、セキュリティコンサルなど、当社のサービスに関するご相談・ご依頼・ご質問を受け付けております。お気軽にご連絡ください。";
	$keywords = "シティクラフト,システム開発,IT基盤,システムエンジニア,システムアーキテクチャ設計,フレームワーク開発、クラウド基盤構築、セキュリティコンサル,お問い合わせ";
}elseif($uri == $contact_conf){
	$title = "お問い合わせ確認｜名古屋のIT基盤開発・クラウド構築ならシティクラフト";
	$description = "シティクラフトのお問い合わせ確認ページです。お問い合わせ内容をご確認後送信下さい。";
	$keywords = "シティクラフト,システム開発,IT基盤,システムエンジニア,システムアーキテクチャ設計,フレームワーク開発、クラウド基盤構築、セキュリティコンサル,お問い合わせ";
}elseif($uri == $contact_regist){
	$title = "お問い合わせありがとうございました。｜名古屋のIT基盤開発・クラウド構築ならシティクラフト";
	$description = "シティクラフトへのお問い合わせありがとうございました。担当が内容を確認後ご返信させていただきます。";
	$keywords = "シティクラフト,システム開発,IT基盤,システムエンジニア,システムアーキテクチャ設計,フレームワーク開発、クラウド基盤構築、セキュリティコンサル,お問い合わせ";
}else{
	$title = "名古屋のIT基盤・クラウド構築に強いエンジニア集団｜株式会社シティクラフト";
	$description = "シティクラフトは、システムアーキテクチャ設計からフレームワーク開発、クラウド基盤構築、セキュリティコンサルまで、IT基盤と仕組みを提供しています。確かな技術力と将来を見据えた提案力で、持続可能な成長と確かな価値を創出しています。";
	$keywords = "シティクラフト,システム開発,IT基盤,システムエンジニア,システムアーキテクチャ設計,フレームワーク開発、クラウド基盤構築、セキュリティコンサル,";
} ?>

<title><?php echo $title; ?></title>
<meta name="Description" content="<?php echo $description; ?>">
<meta name="Keywords" content="<?php echo $keywords; ?>">

<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="format-detection" content="telephone=no">

<link href="/common/css/base.css" rel="stylesheet" type="text/css" />
<link href="/common/css/layout.css?<?php echo date('Ymd-Hi'); ?>" rel="stylesheet" type="text/css" />
<script src="/common/js/jquery.min.js"></script>
<script src="/common/js/common.js"></script>

<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://use.typekit.net/sjy7rcy.css">

</head>

<body id="<?php if($_SERVER['REQUEST_URI']=="/"  ||  $_SERVER['REQUEST_URI']=="/top" ){echo "index";}else{echo "subPage";} ?>">
<p id="pagetop"></p>

<header id="header">
  <div class="headerWrap d-flex jc-between">
    <p class="hLogo">
      <a href="/">
        <img src="/common/img/logo_black.svg" alt="株式会社シティクラフト">
      </a>
    </p>
    <nav class="hNav d-flex">
      <ul class="d-flex">
        <li><a href="/company">企業情報 </a></li>
        <li><a href="/business">事業内容</a></li>
        <li><a href="/access">アクセス</a></li>
        <li><a href="/recruit">採用情報</a></li>
      </ul>
    </nav>
  </div>
</header>
<div class="menuIconWrap">
  <div class="menuIcon"><span></span><span></span><span></span></div>
</div>
<div id="nav" class="spMenu onlysp">
  <p class="spLogo">
    <a href="/">
      <img src="/common/img/logo_black.svg" alt="株式会社シティクラフト">
    </a>
  </p>
  <nav class="spNav">
    <ul>
      <li class="enTtl"><a href="/"><span class="fontEn">Top</span>トップ</a></li>
      <li class="enTtl"><a href="/company"><span class="fontEn">Company</span>企業情報</a></li>
      <li><a href="/company/message">代表メッセージ</a></li>
      <li><a href="/company/overview">会社概要</a></li>
      <li><a href="/company/overview#license">ISMS認証</a></li>
      <li><a href="/company/overview#history">沿革</a></li>
      <li class="enTtl"><a href="/business"><span class="fontEn">Business</span>事業内容</a></li>
      <li class="enTtl"><a href="/access"><span class="fontEn">Access</span>アクセス</a></li>
      <li class="enTtl"><a href="/recruit"><span class="fontEn">Recruit</span>採用情報</a></li>
      <li><a href="/recruit/about">求職者向け会社案内</a></li>
      <li><a href="/recruit/careerplan">キャリアプラン・制度</a></li>
      <li><a href="/recruit/workstyle">働き方・福利厚生</a></li>
      <li><a href="/recruit/people">先輩社員の声</a></li>
      <li><a href="/recruit/jobposting">募集要項</a></li>
      <li><a href="/recruit/entry">エントリーフォーム</a></li>
      <li class="enTtl"><a href="/policies"><span class="fontEn">Policies</span>各種ポリシー</a></li>
      <li><a href="/policies#privacy">個人情報保護方針</a></li>
      <li><a href="/policies#security">情報セキュリティ基本方針</a></li>
      <li><a href="/policies#environment">環境方針</a></li>
      <li class="enTtl"><a href="/contact"><span class="fontEn">Contact</span>お問い合わせ</a></li>
    </ul>
  </nav>
</div>