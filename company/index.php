<?php
include(__DIR__ . "/../header.php");
?>

<main id="companyPage">

  <section class="lower_mv js-scroll">
    <div class="container">
      <div class="area">
        <h1><span class="fontEn js-clip">Company</span><br><span class="jaTxt js-clip">企業情報</span></h1>
        <figure class="bgImg"><img src="/common/img/company/lower_mv_bg.jpg" alt="エンジニアの写真"></figure>
      </div>
      <nav class="pankz" aria-label="パンくずリスト">
        <ol>
          <li><a href="/">トップ</a></li>
          <li aria-current="page">企業情報</li>
        </ol>
      </nav>
    </div>
  </section>


  <article>
    <section id="companySec" class="companySec bgGray02">
      <div class="container">
        <div class="companyRow d-grid js-scroll">
          <a href="/company/message" class="js-clip _01">
            <figure class="img"><img src="/common/img/company/message.jpg" alt="代表の写真"></figure>
            <h2 class="ttl"><span class="fontEn">Message</span>代表メッセージ</h2>
          </a>
          <a href="/company/overview" class="js-clip _02">
            <figure class="img"><img src="/common/img/company/overview.jpg" alt="会社の内観写真"></figure>
            <h2 class="ttl"><span class="fontEn">Overview</span>会社概要</h2>
          </a>
          <a href="/company/overview#license" class="js-clip _03">
            <figure class="img"><img src="/common/img/company/license.jpg" alt="ITのイメージ画像"></figure>
            <h2 class="ttl"><span class="fontEn">License</span>ISMS認証</h2>
          </a>
          <a href="/company/overview#history" class="js-clip _04">
            <figure class="img"><img src="/common/img/company/history.jpg" alt="会社の内観写真"></figure>
            <h2 class="ttl"><span class="fontEn">History</span>沿革</h2>
          </a>
        </div>
      </div>
    </section>

  </article>

</main>


<?php
include(__DIR__ . "/../footer.php");
?>