<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>check_form</title>
</head>

<style>
  .content{
    width: 100%;
  }
  .ttl-contact{
    width: 100%;
    display: flex;
  }
  .ttl-contact-text{
    margin: auto;
  }

  table{
    margin: 20px auto 0px auto;
    width: 45%;
  }
  td{
    width: 45%;
  }
  .content-til{
    margin-right:80px;
  }

  .check-content{
    display: flex;
    flex-direction: column;
  }
  .check-btn{
    padding: 10px 60px;
    margin: 20px 0px;
    border: 1px solid black;
    border-radius: 5px;
    background-color: black;
    color: white;
    font-size: 15px;
    cursor: pointer;
  }
  .btn-size{
    width: 100%;
    text-align: center;
  }
  .top-content-til{
    text-align: left;
  }
  .reset-btn{
    border: none;
    background: transparent;
    border-bottom: solid 1px black;
    cursor: pointer;
    padding-bottom: 0px;
  }
</style>

<body>
  <div class="ttl-contact">
    <h1 class="ttl-contact-text">内容確認</h1>
  </div>

  <div class="content">

    <form action="send" method="post">
      @csrf
      <table>
        <tr>
          <th class="top-content-til">
            <p class="content-til">お名前</p>
          </th>
          <td>
            <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
            <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
            <p>{{ $contact['first_name'] }} {{ $contact['last_name'] }}</p>
          </td>
        </tr>

        <tr>
          <th class="top-content-til">
            <p class="content-til">性別</p>
          </th>
          <td>
            @if($contact['gender_id'] === '1')
              <p>男性</p>
              <input style="display:none" type="radio" name="gender_id" value="1" {{ old('gender_id') === '1' ? 'checked' : '' }} checked>
            @else($contact['gender_id'] === '2')
              <p>女性</p>
              <input style="display:none" type="radio" name="gender_id" value="2" {{ old('gender_id') === '2' ? 'checked' : '' }} checked>
            @endif
          </td>
        </tr>

        <tr>
          <th class="top-content-til">
            <p class="content-til">メールアドレス</p>
          </th>
          <td>
            <input type="hidden" name="email" value="{{ $contact['email'] }}">
            <p>{{ $contact['email'] }}</p>
          </td>
        </tr>

        <tr>
          <th class="top-content-til">
            <p class="content-til">郵便番号</p>
          </th>
          <td>
            <input type="hidden" name="postal" value="{{ $contact['postal'] }}">
            <p><span>〒</span> {{ $contact['postal'] }}</p>
          </td>
        </tr>

        <tr>
          <th class="top-content-til">
            <p class="content-til">住所</p>
          </th>
          <td>
            <input type="hidden" name="address" value="{{ $contact['address'] }}">
            <p>{{ $contact['address'] }}</p>
          </td>
        </tr>

        <tr>
          <th class="top-content-til">
            <p class="content-til">建物名</p>
          </th>
          <td>
            <input type="hidden" name="building_name" value="{{ $contact['building_name'] }}">
            <p>{{ $contact['building_name'] }}</p>
          </td>
        </tr>

        <tr>
          <th class="top-content-til">
            <p class="content-til">ご意見</p>
          </th>
          <td>
            <textarea style="display:none" name="content" cols="30" rows="10">{{ $contact['content'] }}</textarea>
            <p>{{ $contact['content'] }}</p>
          </td>
        </tr>
      </table>

      <div class="check-content">
        <div class="btn-size">
          <input class="check-btn" type="submit" value="送信">
        </div>
        <div class="btn-size">
          <button class="reset-btn" type="submit" name='back' value="back">修正する</button>
        </div>
      </div>
    </form>

  </div>

</body>

</html>