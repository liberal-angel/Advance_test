<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
  <title>Contact_form</title>
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
  }
  .content-til{
    margin-right:80px;
  }
  .first-name-content{
    margin-left: 100px;
    text-align: left;
  }
  .last-name-content{
    margin-left: 30px;
    text-align: right;
  }
  .first-name-content, .last-name-content{
    width: 300px;
  }
  .first-name-input,
  .last-name-input{
    width: 95%;
  }

  .radio-input{
    appearance: none;
    position: absolute;
  }
  .radio-text::before{
    content: '';
    display: block;
    border-radius: 50%;
    border: 1px solid black;
    width: 48px;
    height: 48px;
    margin-right: 10px;
    cursor: pointer;
  }
  .radio-input:checked + .radio-text::after{
    content: '';
    position: absolute;
    left: 19px;
    display: block;
    border-radius: 50%;
    border: 1px solid black;
    width: 10px;
    height: 10px;
    background-color: black;
    cursor: pointer;
  }
  .radio-text{
    display: flex;
    position: relative;
    align-items: center;
    margin: 20px 0 20px 0;
  }

  .postal-content{
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .contact-input{
    border-radius: 5px;
    border: solid 1px black;
    height: 120px;
  }

  .check-content{
    text-align: center;
  }
  .check-btn{
    padding: 10px 60px;
    margin: 20px 0px;
    border: 1px solid black;
    border-radius: 5px;
    background-color: black;
    color: white;
    font-size: 15px;
  }

  .※::after{
    content:"※";
    color: red;
    margin-left: 5px;
  }
  .example{
    margin: 0px 0px 0px 30px;
    color: gray;
  }
  .max-size-input{
    width: 100%;
    box-sizing: border-box;
  }
  .add-content{
    border-radius: 5px;
    border: solid 1px black;
    height: 30px;
  }
  .top-content-til{
    text-align: left;
  }
  .txt-center{
    text-align: center;
  }

  .error_til{
    width: 50%;
    margin: auto;
    padding: 0px 10px;
    background-color: #ffc9c9;
  }
  .error-message{
    color: red;
  }
</style>

<body>
  <div class="ttl-contact">
    <h1 class="ttl-contact-text">お問い合わせ</h1>
  </div>

  <div class="content">

    @if(count($errors)>0)
      <div class="error_til">
        <p>下記のいずれかの入力内容に問題があります。</p>
      </div>
    @endif

    <form action="check" method="post">
      @csrf
      <table>

        <tr>
          <th class="top-content-til">
            <p class="content-til ※">お名前</p>
          </th>
          <td class="first-name-content">
            <input class="first-name-input add-content" type="text" name="first_name" value="{{ old('first_name') }}">
          </td>
          <td class="last-name-content">
            <input class="last-name-input add-content" type="text" name="last_name" value="{{ old('last_name') }}">
          </td>
        </tr>
        @if(count($errors)>0)
          <tr>
            <th></th>
            <td>
              @error('first_name')
                <p class="error-message">{{$message}}</p>
              @enderror
            </td>
            <td>
              @error('last_name')
                <p class="error-message">{{$message}}</p>
              @enderror
            </td>
          </tr>
        @endif
        <tr>
          <th></th>
          <td> <p class="example">例）山田</p> </td>
          <td> <p class="example">例）太郎</p> </td>
        </tr>

        <tr>
          <th class="top-content-til">
            <p class="content-til ※">性別</p>
          </th>
          <td>
            <label class="radio-content">
              <input class="radio-input" type="radio" name="gender_id" value="1" {{ old('gender_id') === '1' ? 'checked' : '' }} checked>
              <span class="radio-text">男性</span>
            </label>
          </td>
          <td>
            <label class="radio-content">
              <input class="radio-input" type="radio" name="gender_id" value="2" {{ old('gender_id') === '2' ? 'checked' : '' }}>
              <span class="radio-text">女性</span>
            </label>
          </td>
        </tr>

        <tr>
          <th class="top-content-til">
            <p class="content-til ※">メールアドレス</p>
          </th>
          <td colspan="2">
            <input class="max-size-input add-content" type="email" name="email" value="{{ old('email') }}">
            @if(count($errors)>0)
              @error('email')
                <p class="error-message">{{$message}}</p>
              @enderror
            @endif
          </td>
          <tr>
            <th></th>
            <td>
              <p class="example">例) test@example.com</p>
            </td>
          </tr>
        </tr>

        <tr>
          <th class="top-content-til">
            <p class="content-til ※">郵便番号</p>
          </th>
          <td colspan="2">
            <div class="postal-content">
              <span>〒</span>
              <input class="max-size-input add-content" type="text" name="postal" value="{{ old('postal') }}" onKeyUp="AjaxZip3.zip2addr('postal', '', 'address', 'address');">
            </div>
            @if(count($errors)>0)
              @error('postal')
                <p class="error-message">{{$message}}</p>
              @enderror
            @endif
          </td>
        </tr>
        <tr>
          <th></th>
          <td>
            <p class="example">例) 123-4567</p>
          </td>
        </tr>

        <tr>
          <th class="top-content-til">
            <p class="content-til ※">住所</p>
          </th>
          <td colspan="2">
            <input class="max-size-input add-content" type="text" name="address" value="{{ old('address') }}">
            @if(count($errors)>0)
              @error('address')
                <p class="error-message">{{$message}}</p>
              @enderror
            @endif
          </td>
          <tr>
            <th></th>
            <td>
              <p class="example">例) 東京都渋谷区千駄ヶ谷1-2-3</p>
            </td>
          </tr>
        </tr>

        <tr>
          <th class="top-content-til">
            <p class="content-til">建物名</p>
          </th>
          <td colspan="2"><input class="max-size-input add-content" type="text" name="building_name" value="{{ old('building_name') }}"></td>
          <tr>
            <th></th>
            <td>
              <p class="example">例) 千駄ヶ谷マンション101</p>
            </td>
          </tr>
        </tr>

        <tr>
          <th class="top-content-til">
            <p class="content-til ※">ご意見</p>
          </th>
          <td colspan="2">
            <textarea class="max-size-input contact-input" name="content" cols="30" rows="10">{{ old('content') }}</textarea>
            @if(count($errors)>0)
              @error('content')
                <p class="error-message">{{$message}}</p>
              @enderror
            @endif
          </td>
        </tr>
      </table>

      <div class="check-content">
        <input class="check-btn" type="submit" value="確認" @click="onClick">
      </div>
    </form>

  </div>

</body>

</html>