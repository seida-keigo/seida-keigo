var start=document.querySelector("#start");
var stop=document.querySelector("#stop");
var reset=document.querySelector("#reset");

var unselectedCells=[...document.querySelectorAll("#display td")];
var lightingCell/*光っているセル*/;

start.addEventListener("click",()=>{
    //ボタンを変える
    start.setAttribute("disabled","");
    reset.removeAttribute("disabled");
    if(lightingCell!==undefined){
        //lightingCellがtd要素であれば、lightingCellを半透明の#f00にする
        lightingCell.style.background="rgba(255,0,0,.5)";
    }
    if(unselectedCells.length>=1){
        //unselectedCellsからランダムに選んでlightingCellに代入し、lightingCellの背景を#f00にする
        lightingCell=unselectedCells[Math.floor(unselectedCells.length*Math.random())];
        lightingCell.style.background="#f00";
    }
    if(unselectedCells.length>=2){
        //ボタンを変え、intervalを起動する
        stop.removeAttribute("disabled");
        var interval=setInterval(()=>{
            //lightingCellの背景を透明にする
            lightingCell.style.background="transparent";
            //再び、unselectedCellsからランダムに選んでlightingCellに代入し、lightingCellの背景を#f00にする
            lightingCell=unselectedCells[Math.floor(unselectedCells.length*Math.random())];
            lightingCell.style.background="#f00";
        },50/3);
    }
    
    stop.addEventListener("click",()=>{
        //ボタンを変え、intervalを停める
        start.removeAttribute("disabled");
        stop.setAttribute("disabled","");
        clearInterval(interval);
        //unselectedCellsからlightingCellを除く
        unselectedCells=unselectedCells.filter(cell=>cell!==lightingCell);
    },false);

    reset.addEventListener("click",()=>{
        //ボタンを変え、intervalを停める
        start.removeAttribute("disabled");
        stop.setAttribute("disabled","");
        reset.setAttribute("disabled","");
        clearInterval(interval);
        //td背景とunselectedCellsとlightingCellを初期化する
        for(cell of document.querySelectorAll("#display td")){
            cell.style.background="transparent";
        }
        unselectedCells=[...document.querySelectorAll("#display td")];
        lightingCell=undefined;
    },false);
},false);