<h1>글 상세</h1>

<article>
  <h3><?= $view->subject; ?></h3>
  <p>작성일: <?= $view->regdate; ?> / 작성자: <?= $view->userid; ?></p>
  <h4>본문</h4>
  <p>
  <?= $view->content; ?>
  </p>
</article>

<a href="/board/">목록</a>
<a href="/board/write">글쓰기</a>
  