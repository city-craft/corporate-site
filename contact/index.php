<?php
include(__DIR__ . "/../header.php");
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
    <section id="contactForm" class="contactForm bgGray02">
      <div class="container">
        <p class="lead alnleft">お問い合わせフォームは現在停止しています。</p>
        <div class="formArea js-scroll fadeInUp">
          <div class="formWrap">
            <p class="txtSet alnleft">現在、このサイト上でのお問い合わせ受付を停止しています。</p>
            <p class="txtSet alnleft">受付再開までお待ちください。</p>
            <div class="formBtn d-flex jc-center ai-center f-wrap">
              <div><a href="/" class="btnCont">トップへ戻る</a></div>
            </div>
          </div>
          <!--
          <form action="conf.php" method="post">
            <div class="formWrap">
              <dl class="formBox">
                <dt class="req">お問い合わせ種別</dt>
                <dd class="radioWrap d-flex">
                  <label><input type="radio" name="type" required value="個人のお客様">個人のお客様</label>
                  <label><input type="radio" name="type" required value="法人のお客様">法人のお客様</label>
                </dd>
                <dt class="req">お名前</dt>
                <dd>
                  <input type="text" name="name" required pattern=".*\S+.*">
                </dd>
                <dt class="req">フリガナ</dt>
                <dd>
                  <input type="text" name="kana" required pattern="^[\u30A0-\u30FFー\s]+$" title="全角カタカナで入力してください（長音記号・空白も可）">
                </dd>
                <dt>会社名</dt>
                <dd>
                  <input type="text" name="company02" pattern=".*\S+.*">
                </dd>
                <dt class="req">電話番号</dt>
                <dd>
                  <input type="text" name="tel" placeholder="000-0000-0000" required pattern="\d{2,4}-?\d{2,4}-?\d{3,4}">
                </dd>
                <dt class="req">メールアドレス</dt>
                <dd>
                  <input type="email" name="email" placeholder="example@mail.com" required>
                </dd>
                <dt class="req">お問い合わせ内容</dt>
                <dd>
                  <textarea name="detail" required pattern=".*\S+.*"></textarea>
                </dd>
              </dl>
              <p class="privacyCheck">
                <label><input type="checkbox" name="privacy" value="プライバシーポリシーに同意する" required>「<a href="/policies/#privacy" class="uline" target="_blank" rel="noopener noreferrer">プライバシーポリシー</a>」に同意する</label>
              </p>
              <div class="formBtn d-flex jc-center ai-center f-wrap">
                <div><input type="submit" name="submitConfirm" value="入力内容を確認する" class="btnCont"></div>
              </div>
            </div>
          </form>
          -->
        </div>
      </div>
    </section>
  </article>

</main>



<?php
include(__DIR__ . "/../footer.php");
?>