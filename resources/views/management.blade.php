<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
  <title>Management</title>
</head>

<style>
  .ttl-contact{
    width: 100%;
    display: flex;
  }
  .ttl-contact-text{
    margin: auto;
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
  .gender-search-item:not(last-child){
    margin-right: 30px;
  }
 
  .search-system{
    border: solid 2px black;
    width: 80%;
    margin: auto;
    padding: 20px 30px;
  }
  .search-list{
    display: flex;
    justify-content: left;
    align-items: center;
    width: 100%;
  }
  .search-list:not(last-child){
    margin-bottom: 20px;
  }
  .search-content{
    display: flex;
    align-items: center;
  }
  .name-search-width{
    width: 50%;
  }
  .date-search-width{
    width: 100%;
  }
  .content-til{
    font-size: 18px;
    font-weight: bold;
    width: 140px;
    margin-right: 20px;
  }
  .add-content{
    border-radius: 5px;
    border: solid 1px black;
    height: 50px;
    width: 240px;
    font-size: 16px;
    text-align: center;
  }
  .over-line{
    margin: 0 25px 0 25px;
  }

  .search-btn-content{
    text-align: center;
  }
  .search-btn{
    padding: 10px 60px;
    margin: 20px 0px;
    border: 1px solid black;
    border-radius: 5px;
    background-color: black;
    color: white;
    font-size: 15px;
    cursor: pointer;
  }
  .reset-btn{
    border: none;
    background: transparent;
    border-bottom: solid 1px black;
    cursor: pointer;
  }

  .resolt-content{
    width: 80%;
    margin: auto;
  }
  .resolt-table{
    width: 100%;
  }
  .resolt-content-item{
    width: 12%;
    height: 50px;
    text-align: center;
  }
  .resolt-content-opinion{
    height: 50px;
    width: 40%;
    text-align: center;
  }
  .resolt-delete-btn{
    width: 5%;
  }

  svg.w-5.h-5 {
    width: 30px;
    height: 30px;
  }

  .page-content{
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .gender-txt{
    margin: 0;
  }
</style>

<body>
  <div class="ttl-contact">
    <h1 class="ttl-contact-text">管理システム</h1>
  </div>

  <div class="system">
    <form action="search" method="post">
      @csrf
      <div class="search-system">
        <div class="search-list">
          <div class="search-content name-search-width">
            <p class="content-til">お名前</p>
            <input class="add-content" type="text" name="name">
          </div>

          <div class="search-content name-search-width">
            <div>
              <p class="content-til">性別</p>
            </div>
            <div class="gender-search-item">
              <label class="radio-content">
                <input class="radio-input" type="radio" name="gender_id" value="" checked>
                <span class="radio-text">全て</span>
              </label>
            </div>
            <div class="gender-search-item">
              <label class="radio-content">
                <input class="radio-input" type="radio" name="gender_id" value="1">
                <span class="radio-text">男性</span>
              </label>
            </div>
            <div class="gender-search-item">
              <label class="radio-content">
                <input class="radio-input" type="radio" name="gender_id" value="2">
                <span class="radio-text">女性</span>
              </label>
            </div>
          </div>
        </div>

        <div class="search-list search-content date-search-width">
          <p class="content-til">登録日</p>
          <input class="add-content" type="date" name="first_created" value="2022-01-01" min="2022-01-01" max="2023-12-31">
          <span class="over-line">～</span>
          <input class="add-content" type="date" name="last_created" value="2023-12-31" min="2022-01-01" max="2023-12-31">
        </div>

        <div class="search-list search-content date-search-width">
          <p class="content-til">メールアドレス</p>
          <input class="add-content" type="email" name="email">
        </div>

        <div class="search-btn-content">
          <input class="search-btn" type="submit" value="検索">
        </div>
    </form>
        <div class="search-btn-content">
          <form action="search">
            <input class="reset-btn" type="submit" value="リセット">
          </form>
        </div>
      </div>
  </div>
  
  <div class="resolt-content">
    @if(@isset($Contacts))
      <div class="page-content">
        <div>
          @if (count($Contacts) >0)
          <p>全{{ $Contacts->total() }}件中 
            {{  ($Contacts->currentPage() -1) * $Contacts->perPage() + 1}} - 
            {{ (($Contacts->currentPage() -1) * $Contacts->perPage() + 1) + (count($Contacts) -1)  }}件</p>
          @else
            <p>データがありません。</p>
          @endif
        </div>
        <div>
          {{ $Contacts->appends(request()->query())->links() }}
        </div>
      </div>

      <table class="resolt-table">
        <tr style="border-bottom: 2px solid black;">
          <th class="resolt-content-item">ID</th>
          <th class="resolt-content-item">お名前</th>
          <th class="resolt-content-item">性別</th>
          <th class="resolt-content-item">メールアドレス</th>
          <th class="resolt-content-opinion">ご意見</th>
          <th class="resolt-content-item"></th>
        </tr>
        @foreach($Contacts as $Contact)
          <tr>
            <td class="resolt-content-item">{{$Contact['id']}}</td>
            <td class="resolt-content-item">{{$Contact->FullName}}</td>
            <td class="resolt-content-item">
              @if($Contact -> gender_id === 1)
                <p class="gender-txt">男性</p>
              @elseif($Contact -> gender_id === 2)
                <p class="gender-txt">女性</p>
              @endif
            </td>
            <td class="resolt-content-item">{{$Contact['email']}}</td>
            <td class="resolt-content-opinion">{{Str::limit($Contact->content, 25, '…' )}}</td>
            <td class="resolt-delete-btn">
              <form action="delete/{{$Contact['id']}}" method="post">
                @csrf
                <input type="hidden" name="first_name" value="{{$Contact->first_name}}">
                <input type="hidden" name="last_name" value="{{$Contact->last_name}}">
                <input type="hidden" name="gender_id" value="{{$Contact->gender_id}}">
                <input type="hidden" name="email" value="{{$Contact->email}}">
                <input type="hidden" name="created_at" value="{{$Contact->created_at}}">
                <button>削除</button>
              </form>
            </td>
          </tr>
        @endforeach
      </table>
    @endif
  </div>
</body>

</html>