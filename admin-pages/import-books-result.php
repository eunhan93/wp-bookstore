<div class="wrap">

<?php 
    if($response_code !== 200){
      echo '<h2> 에러 : ' . $body -> errorType . '</h2>';
      echo '<p>' . $body -> message . '</p>';
    } else {
  ?>
  <h2>검색 결과</h2>
  <p><?php echo number_format($body -> meta -> total_count); ?>개</p>
  <table class="widefat striped">
    <thead>
      <tr>
        <th scope="col">표지</th>
        <th scope="col">제목</th>
        <th scope="col">저자</th>
        <th scope="col">출판사</th>
        <th scope="col">발행일</th>
      </tr>
    </thead>
    <tbody>
  <?php 
    foreach ($body -> documents as $book) { ?>
    <tr>
      <td><img src="<?php echo $book -> thumbnail; ?>" alt="<?php echo $book -> title; ?> 표지" height="100"></td>
      <td><?php echo $book -> title; ?></td>
      <td><?php echo implode(',', $book -> authors); ?></td>
      <td><?php echo $book -> publisher; ?></td>
      <td nowrap><?php echo date('Y-m-d', strtotime($book -> datetime)); ?></td>
      <td nowrap>
      <?php if($book -> is_duplication) {?>
        <button class="button js-import" data-book="<?php echo base64_encode(json_encode($book)); ?>" disabled>가져옴</button>
      <?php } else {?>
        <button class="button js-import" data-book="<?php echo base64_encode(json_encode($book)); ?>">임포트</button>
      <?php }?>
      </td>
    </tr>
  <?php
    }
  }
  ?>
  </tbody>
</table>


<?php
  if(!$body -> meta -> is_end){ ?>
  <p style="text-align : center">
    <?php if($request_page > 1) {?>
    <a href="?post_type=book&page=import-books&query=<?php echo $_GET['query'] ?>&request_page=<?php echo $_GET['request_page'] - 1;?>">이전페이지</a>
    |
    <?php }?>
    <a href="?post_type=book&page=import-books&query=<?php echo $_GET['query'] ?>&request_page=<?php echo ($_GET['request_page'] + 1);?>">다음페이지</a>
  </p>

<?php } else {?>
  <p style="text-align : center">마지막</p>

<?php } ?>

</div>


