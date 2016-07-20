<div id="status">
  <div class="container">
  <div class="row">
    <div class="col-xs-1">
      <div class="device stopped" id="unstack-robot">
        <span>拆垛机械手</span>
        <div class="no-sheet" id="unr-hasSheet"></div>
      </div>
    </div>
    <div class="col-xs-1">
      <div class="device stopped" id="ffr-robot">
        <span>加热炉上料机械手</span>
        <div class="no-sheet" id="ffr-hasSheet"></div>
      </div>
    </div>
    <div class="col-xs-3">
      <div class="device stopped" id="furnacesB">
        <span>多层加热炉B</span>
        <div class="stopped" id='fb0'>0</div><div class="no-sheet" id="fb0-hasSheet"></div>
        <div class="stopped" id='fb1'>1</div><div class="no-sheet" id="fb1-hasSheet"></div>
        <div class="stopped" id='fb2'>2</div><div class="no-sheet" id="fb2-hasSheet"></div>
        <div class="stopped" id='fb3'>3</div><div class="no-sheet" id="fb3-hasSheet"></div>
        <div class="stopped" id='fb4'>4</div><div class="no-sheet" id="fb4-hasSheet"></div>
        <div class="stopped" id='fb5'>5</div><div class="no-sheet" id="fb5-hasSheet"></div>
        <div class="stopped" id='fb6'>6</div><div class="no-sheet" id="fb6-hasSheet"></div>
        <div class="stopped" id='fb7'>7</div><div class="no-sheet" id="fb7-hasSheet"></div>
        <div class="stopped" id='fb8'>8</div><div class="no-sheet" id="fb8-hasSheet"></div>
        <div class="stopped" id='fb9'>9</div><div class="no-sheet" id="fb9-hasSheet"></div>
        <div class="stopped" id='fbA'>A</div><div class="no-sheet" id="fbA-hasSheet"></div>
        <div class="stopped" id='fbB'>B</div><div class="no-sheet" id="fbB-hasSheet"></div>
      </div>
      <div class="device stopped" id="furnaces-doorB">
        <span>炉B炉门机械手</span>
        <span class="furnaces-door" id="furnacesB-opr-number"></span>
      </div>
      <div class="device stopped" id="furnacesA">
        <span>多层加热炉A</span>
        <div class="stopped" id='fa0'>0</div><div class="no-sheet" id="fa0-hasSheet"></div>
        <div class="stopped" id='fa1'>1</div><div class="no-sheet" id="fa1-hasSheet"></div>
        <div class="stopped" id='fa2'>2</div><div class="no-sheet" id="fa2-hasSheet"></div>
        <div class="stopped" id='fa3'>3</div><div class="no-sheet" id="fa3-hasSheet"></div>
        <div class="stopped" id='fa4'>4</div><div class="no-sheet" id="fa4-hasSheet"></div>
        <div class="stopped" id='fa5'>5</div><div class="no-sheet" id="fa5-hasSheet"></div>
        <div class="stopped" id='fa6'>6</div><div class="no-sheet" id="fa6-hasSheet"></div>
        <div class="stopped" id='fa7'>7</div><div class="no-sheet" id="fa7-hasSheet"></div>
        <div class="stopped" id='fa8'>8</div><div class="no-sheet" id="fa8-hasSheet"></div>
        <div class="stopped" id='fa9'>9</div><div class="no-sheet" id="fa9-hasSheet"></div>
        <div class="stopped" id='faA'>A</div><div class="no-sheet" id="faA-hasSheet"></div>
        <div class="stopped" id='faB'>B</div><div class="no-sheet" id="faB-hasSheet"></div>
      </div>
      <div class="device stopped" id="furnaces-doorA">
        <span>炉A炉门机械手</span>
        <span class="furnaces-door" id="furnacesA-opr-number"></span>
      </div>
    </div>
    <div class="col-xs-1">
      <div class="device stopped" id="fur-robot">
        <span>加热炉下料机械手</span>
        <div class="no-sheet" id="fur-hasSheet"></div>
      </div>
    </div>
    <div class="col-xs-1">
      <div class="device stopped" id="pfr-robot">
        <span>压力机上料机械手</span>
        <div class="no-sheet" id="pfr-hasSheet"></div>
      </div>
    </div>
    <div class="col-xs-1">
      <div class="device stopped" id="press">
        <span>压力机</span>
        <div class="no-sheet" id="press-hasSheet"></div>
      </div>
    </div>
    <div class="col-xs-1">
      <div class="device stopped" id="pur-robot">
        <span>压力机下料机械手</span>
        <div class="no-sheet" id="pur-hasSheet"></div>
      </div>
    </div>
    <div class="col-xs-3">
      <ul class="device-status-list">
        <li><span class="device-statue-block running"></span><span>设备正常</span></li>
        <li><span class="device-statue-block stopped"></span><span>设备停机</span></li>
        <li><span class="device-statue-block warning"></span><span>设备报警</span></li>
        <li><span class="device-statue-block has-sheet"></span><span>持有板料</span></li>
        <li><span class="device-statue-block no-sheet"></span><span>未持板料</span></li>
      </ul>
      <ul class="communication-status-list">
        <li class="fault"><span id="comm-gas">保护气体</span></li>
        <li class="fault"><span id="comm-furnacesA">加热炉A</span></li>
        <li class="fault"><span id="comm-furnacesB">加热炉B</span></li>
        <li class="fault"><span id="comm-unstackRobot">拆垛机械手</span></li>
        <li class="fault"><span id="comm-robotGroup">机械手群</span></li>
        <li class="fault"><span id="comm-press">压力机</span></li>
      </ul>
    </div>
  </div>
</div>
</div>