<h2 id=navbar>
  <!--esquerra-->
  <div class=flex>
    <div>🔥🔥</div>
    <div onclick=window.location='index.php'>
      Sant Joan Boreal 2018
    </div>
    <div>
      <span onclick="window.location='login.php'">🔥</span>🔥
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
