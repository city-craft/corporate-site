<?php
	header('Content-Type: text/html; charset=UTF-8');
	header("X-Robots-Tag: noindex, nofollow");
?>


<?php
	include( __DIR__ . "/../header.php");
?>

<main id="contactPage">

  <section class="lower_txt">
    <div class="container">
      <h1><span class="fontEn">Contact</span>お問い合わせ</h1>
      <nav class="pankz" aria-label="パンくずリスト">
        <ol>
          <li><a href="/">トップ</a></li>
          <li aria-current="page">お問い合わせ</li>
        </ol>
      </nav>
    </div>
  </section>

  <article>
		<section id="request-thx" class="bgGray02">
			<div class="container">
				<div class="thxBox">
					<b>お問い合わせフォームは現在停止しています。</b>
          <p class="alncenter mt10">現在、このサイト上からの送信処理を停止しています。受付再開までお待ちください。</p>
					<p class="alncenter mt20"><a href="/contact/">お問い合わせページに戻る &gt;</a></p>
				</div>
			</div>
    </section>
  </article>

</main>

<?php
	include( __DIR__ . "/../footer.php");
?>