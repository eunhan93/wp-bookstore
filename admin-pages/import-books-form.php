<div class="wrap">
  <h1>책 가져오기</h1>

  <form method="get">
    <input type="hidden"  name="post_type" value ="book" / >
    <input type="hidden"  name="page" value ="import-books" / >
    <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="query">검색어</label>
          </th>
          <td>
            <input type="text" id="query" name="query" value = "<?php echo ($_GET['query']) ?? '' ?>"/>
          </td>
        </tr>
      </tbody>
    </table>
    <button type="submit" class="button button-primary">검색</button>
    <input type="hidden"  name="request_page" value = "1" / >

  </form>
  
</div>


<!-- dcc2c7da6deb4c18299e5094dd469e21 -->