          <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" id="btnFullscreen" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
           
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="/Home">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->


            <!-- FullScreen Script -->
            <script type="text/javascript">
                            function toggleFullscreen(elem) {
                elem = elem || document.documentElement;
                if (!document.fullscreenElement && !document.mozFullScreenElement &&
                  !document.webkitFullscreenElement && !document.msFullscreenElement) {
                  if (elem.requestFullscreen) {
                    elem.requestFullscreen();
                  } else if (elem.msRequestFullscreen) {
                    elem.msRequestFullscreen();
                  } else if (elem.mozRequestFullScreen) {
                    elem.mozRequestFullScreen();
                  } else if (elem.webkitRequestFullscreen) {
                    elem.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
                  }
                } else {
                  if (document.exitFullscreen) {
                    document.exitFullscreen();
                  } else if (document.msExitFullscreen) {
                    document.msExitFullscreen();
                  } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                  } else if (document.webkitExitFullscreen) {
                    document.webkitExitFullscreen();
                  }
                }
              }

              document.getElementById('btnFullscreen').addEventListener('click', function() {
                toggleFullscreen();
              });

              // document.getElementById('exampleImage').addEventListener('click', function() {
              //   toggleFullscreen(this);
              // });
            </script>