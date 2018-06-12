<div class=flex>
  <button
    id=btn_join
    onclick="window.location='join.php'">
    Apunta'm!
  </button>

  <div id=data_limit>
    &#9202;
    Data límit per apuntar-se: diumenge 17 de juny
    &#9202;
    <style>
      /*animacio*/
      @keyframes blink {
        from {
          opacity:0.2;
        } to {
          opacity:1;
        }
      }

      #data_limit {
        padding:0.4em 0;
        animation:blink 1s infinite alternate;
      }
    </style>
  </div>
</div><hr>

<style>
  #btn_join {
    display:block;
    background-color:#5cb85c;
    border:1px solid transparent;
    border-radius:4px;
    border-color:#ccc;
    color:#fff;
    cursor:pointer;
    font-size:20px;
    font-weight:400;
    line-height:1.42857143;
    outline:none;
    padding:6px 12px;
    text-align:center;
    user-select:none;
    vertical-align:middle;
    white-space:nowrap;
    margin-right:5px;
  }
  #btn_join:hover {
    background-color: #449d44;
    border-color: #398439;
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.05);
  }
  #btn_join:active {
    box-shadow:inset 0 0 10px #000;
  }
</style>
