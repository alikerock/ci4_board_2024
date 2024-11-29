<?php  if(isset($view)){  ?>
  <h1>게시판 - 글수정</h1>
<?php }else{ ?>
  <h1>게시판 - 글쓰기</h1>
<?php } ?>

<form action="<?= site_url('/writeSave')?><?php echo isset($view->bid)?'/?bid='.$view->bid:''; ?>" method="POST">
  <div class="mb-3">
    <label for="subject" class="form-label">제목</label>
    <input type="text" name="subject" class="form-control" id="subject" value="<?= $view->subject; ?>">
  </div>
  <div class="mb-3">
    <label for="content" class="form-label">내용</label>
    <textarea class="form-control" name="content" id="content" rows="3"><?= $view->content; ?></textarea>
  </div>
  <button class="btn btn-primary">등록</button>
</form>
<hr>
<a href="/">home</a>
<a href="/board">목록</a>
