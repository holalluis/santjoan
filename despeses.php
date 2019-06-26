<!doctype html><html><head>
<?php include'imports.php'?>
  <style>
    tr.total{
      background:#ccc;
      font-weight:bold;
    }
    .number{
      text-align:right;
    }
  </style>
</head><body><?php include'navbar.php'?>
<h3>Despeses previstes 2019 (eur)</h3><hr>
<table id=despeses border=1></table>
<script>
  let Despeses=[
    {q:2000, pagat:true,  destí:"ES51 2100 0027 2002 0135 0511", concepte:"compra gran begudes + menjar + cava + coca"}, //max prat
    {q: 340, pagat:true,  destí:"ES45 2100 0412 7301 0036 7389", concepte:"música: 3 trio rumba"},                       //goyo
    {q: 310, pagat:true,  destí:"ES24 2100 0665 4301 0090 1339", concepte:"gestió festa"},                               //jaume madaula
    {q: 250, pagat:true,  destí:"ES26 3025 0014 0714 0008 3269", concepte:"comissió decoració"},                         //georgina nicolás
    {q: 208, pagat:true,  destí:"ES36 1491 0001 2921 3274 5825", concepte:"transport coses + alcohol (lio)"},            //lio dimant
    {q: 200, pagat:true,  destí:"ES85 0182 8730 0102 0091 3346", concepte:"música: 3 el proyecto"},                      //pau (el proyecto)
    {q: 140, pagat:true,  destí:"ES52 2100 0658 0101 0044 3754", concepte:"dj fast fingers + transport"},                //lluís bosch
    {q:  60, pagat:true,  destí:"ES86 3025 0002 4714 3341 4006", concepte:"cubells"},                                    //laia gausà
    {q:  50, pagat:true,  destí:"ES24 2100 0665 4301 0090 1339", concepte:"benzina motor burra"},                        //jaume madaula
    {q:  50, pagat:true,  destí:"ES13 2100 2904 0902 1832 4019", concepte:"rincón de la mierda"},                        //maria andreu hayles
    {q:  50, pagat:true,  destí:"ES18 2100 0695 6101 0034 0733", concepte:"transport so+alcohol (manel)"},               //manel dalmases
    {q:  50, pagat:true,  destí:"ES97 2100 0298 5001 0159 5092", concepte:"música: 1 dj sara"},                          //sara vidal
    {q:  40, pagat:true,  destí:"ES52 2100 0658 0101 0044 3754", concepte:"transport equip de so (diana)"},              //lluís bosch
    {q:  35, pagat:true,  destí:"metàl·lic",                     concepte:"gel"},                                        //gerard codolà
    {q:  30, pagat:true,  destí:"ES19 3025 0014 0014 0008 4417", concepte:"transport so+alcohol (edu)"},                 //edu madaula
    {q:  30, pagat:true,  destí:"ES51 2100 0027 2002 0135 0511", concepte:"transport so+alcohol (max)"},                 //max prat
    {q:  30, pagat:true,  destí:"ES24 2100 0665 4301 0090 1339", concepte:"transport so+alcohol (jaume)"},               //jaume madaula
    {q:  30, pagat:true,  destí:"ES43 1491 0001 2021 3501 9723", concepte:"transport so+alcohol (yves)"},                //yves dimant
    {q:  30, pagat:true,  destí:"metàl·lic",                     concepte:"caixes porex"},                               //ho va comprar gerard codolà
    {q:  23, pagat:true,  destí:"ES52 2100 0658 0101 0044 3754", concepte:"web"},                                        //lluís bosch
    {q:  17, pagat:true,  destí:"ES86 3025 0002 4714 3341 4006", concepte:"coca st joan"},                               //laia gausà
    {q: 375, pagat:false, destí:"ES49 0081 0561 1400 0154 7063", concepte:"lloguer equip de so capsa trons"},             //-- capsa de trons
    {q: 140, pagat:false, destí:"?",                             concepte:"música+viatge: neus i miquel"},                //-- neus
    {q:  50, pagat:false, destí:"?",                             concepte:"comissió gots"},                               //-- duna
    {q:  25, pagat:false, destí:"?",                             concepte:"devolucions no assistents (1)"},               //-- miquel felip peig
  ];

  //totals
  let Totals={
    total    :{q:   0, descr:"TOTAL despeses previstes (pagades + no pagades)" },
    pagat    :{q:   0, descr:"Despeses pagades " },
    no_pagat :{q:   0, descr:"Despeses no pagades"},
    banc     :{q: 877, descr:"Diners al banc actualment" },
    ingressat:{q:   0, descr:"Ingressat total real (banc + pagat)"},
    benefici :{q:   0, descr:"Previsió diners sobrants i/o imprevistos (banc - no-pagat)"},
  };
  Totals.total.q     = Object.values(Despeses).map(d=>d.q).reduce((p,c)=>p+c);
  Totals.pagat.q     = Object.values(Despeses).filter(d=>d.pagat==true ).map(d=>(d.q)).reduce((p,c)=>p+c);
  Totals.no_pagat.q  = Object.values(Despeses).filter(d=>d.pagat==false).map(d=>(d.q)).reduce((p,c)=>p+c);
  Totals.benefici.q  = Totals.banc.q - Totals.no_pagat.q;
  Totals.ingressat.q = Totals.banc.q + Totals.pagat.q;

  //frontend - dibuixa taula
  (function(){
    let table_despeses = document.querySelector('#despeses');
    //despeses
    Despeses.forEach(d=>{
      let nr=table_despeses.insertRow(-1);
      nr.insertCell(-1).outerHTML=`<td class=number>${d.q}`;
      nr.insertCell(-1).innerHTML=d.concepte;
      nr.insertCell(-1).innerHTML=d.pagat?"<b style=color:lightgreen>pagat</b>":"<b style=color:red>no pagat</b>";
      nr.insertCell(-1).innerHTML=d.destí;
    });
    //totals
    Object.entries(Totals).forEach(([key,obj])=>{
      let nr=table_despeses.insertRow(-1);
      nr.classList.add('total');
      nr.insertCell(-1).outerHTML=`<td class=number>${obj.q}`;
      nr.insertCell(-1).outerHTML="<td colspan=3>"+obj.descr;
    });
  })();
</script>
