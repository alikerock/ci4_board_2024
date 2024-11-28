<h1>게시판 - 글쓰기</h1>

<form action="<?= site_url('/writeSave')?>" method="POST">
  <div class="mb-3">
    <label for="subject" class="form-label">제목</label>
    <input type="text" name="subject" class="form-control" id="subject">
  </div>
  <div class="mb-3">
    <label for="content" class="form-label">내용</label>
    <textarea class="form-control" name="content" id="content" rows="3"></textarea>
  </div>
  <button class="btn btn-primary">등록</button>
</form>
<hr>
<a href="/">home</a>
<a href="/board">목록</a>
