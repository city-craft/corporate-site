<?php
include(__DIR__ . "/../../header-recruit.php");
?>

<main id="entrytPage">

  <section class="lower_mv lowerBg js-scroll">
    <div class="container">
      <div class="area">
        <h1 class="js-clip"><span class="fontEn">ENTRY</span>エントリー</h1>
        <figure class="bgImg"><img src="/../common/img/recruit/entry/lower_mv_bg.jpg" alt="パソコンを操作している人の写真"></figure>
      </div>
      <nav class="pankz" aria-label="パンくずリスト">
        <ol>
          <li><a href="../">トップ</a></li>
          <li aria-current="page">エントリー</li>
        </ol>
      </nav>
    </div>
  </section>

  <article>

    <section id="entryForm" class="entryForm">
      <div class="container bgPattern01 _aft">
        <p class="lead txtSet">採用応募フォームは現在停止しています。</p>
        <div class="formArea bgGray js-scroll fadeInUp">
          <div class="formWrap">
            <p class="txtSet alnleft">現在、このサイト上での採用応募受付を停止しています。</p>
            <p class="txtSet alnleft">受付再開までお待ちください。</p>
            <div class="formBtn d-flex jc-center ai-center f-wrap">
              <div><a href="/recruit/" class="btnCont">採用トップへ戻る</a></div>
            </div>
          </div>
          <!--
          <form action="conf.php" method="post" enctype="multipart/form-data">
            <div class="formWrap">
              <dl class="formBox">
                <dt class="req">希望職種</dt>
                <dd class="radioWrap">
                  <label><input type="radio" name="type" required value="プログラマ・システムエンジニア" checked>プログラマ・システムエンジニア</label>
                </dd>
                <dt class="req">お名前</dt>
                <dd>
                  <input type="text" name="name" required pattern=".*\S+.*">
                </dd>
                <dt class="req">フリガナ</dt>
                <dd>
                  <input type="text" name="kana" required pattern="^[\u30A0-\u30FFー\s]+$" title="全角カタカナで入力してください（長音記号・空白も可）">
                </dd>
                <dt class="req">メールアドレス</dt>
                <dd>
                  <input type="email" name="email" placeholder="example@mail.com" required>
                </dd>
                <dt class="req">電話番号</dt>
                <dd>
                  <input type="text" name="tel" placeholder="000-0000-0000" required pattern="\d{2,4}-?\d{2,4}-?\d{3,4}">
                </dd>
                <dt class="req">現所属</dt>
                <dd>
                  <input type="text" name="department" required pattern=".*\S+.*">
                </dd>
                <dt>ご年齢</dt>
                <dd>
                  <input type="text" name="age" class="size-s" pattern=".*\S+.*">歳
                </dd>
                <dt>リンク</dt>
                <dd>
                  <input type="text" name="link" pattern=".*\S+.*">
                  <p class="txt">ポートフォリオサイトやSNSアカウントなど、ご自身に関するWebサイトのURLをご記載ください。</p>
                </dd>
                <dt>備考欄</dt>
                <dd>
                  <textarea name="detail" pattern=".*\S+.*"></textarea>
                  <p class="txt">応募にあたり特別に伝えたいことがあればご記載ください。</p>
                </dd>
              </dl>
              <h2 class="ttl">ファイルアップロード</h2>
              <dl class="formBox">
                <dt class="req">履歴書</dt>
                <dd>
                  <input type="file" name="resume01" accept=".pdf" required/>
                  <p class="txt">PDFファイルでの送付をお願いします。</p>
                </dd>
                <dt class="req">職務経歴書</dt>
                <dd>
                  <input type="file" name="resume02" accept=".pdf" required/>
                  <p class="txt">PDFファイルでの送付をお願いします。</p>
                </dd>
              </dl>
              <p class="privacyCheck">
                <label><input type="checkbox" name="privacy" value="プライバシーポリシーに同意する" required>応募にあたり<a href="/policies/#privacy" class="uline" target="_blank" rel="noopener noreferrer">プライバシーポリシー</a>に<br class="onlysp">同意する</label>
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

    <div class="footerEntry"></div>

  </article>

</main>



<?php
include(__DIR__ . "/../../footer-recruit.php");
?>