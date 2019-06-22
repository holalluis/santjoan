<h2 id=navbar>
  <!--esquerra-->
  <div class=flex>
    <div onclick=window.location='index.php'>
      Sant Joan Boreal 2019
    </div>&nbsp;
    <div>
      <span onclick="window.location='despeses.php'">🔥</span>
      <span onclick="window.location='login.php'">🔥</span>
      <span onclick="window.location='mails.php'">🔥</span>
    </div>
  </div>
  <!--dreta-->
  <?php
    if($admin){ ?>
      <div>
        <button onclick=window.location='logout.php'>
          Sortir admin
        </button>
      </div>
    <?php
    }
  ?>
</h2><hr>
<style>
  #navbar {
    display:flex;
    flex-wrap:wrap;
    justify-content:space-between;
  }
</style>
