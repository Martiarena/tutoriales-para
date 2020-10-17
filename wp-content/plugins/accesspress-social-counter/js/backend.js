(function($) {
     $(function() {
          //All the backend js for the plugin

          /*
           Settings Tabs Switching
           */
          $('.apsc-tabs-trigger').click(function() {
               $('.apsc-tabs-trigger').removeClass('apsc-active-tab');
               $(this).addClass('apsc-active-tab');
               var board_id = 'apsc-board-' + $(this).attr('id');
               $('.apsc-boards-tabs').hide();
               $('#' + board_id).show();
          });

          /**
           * For sortable
           */
          $('.apsc-sortable').sortable({containment: "parent"});

          $('.apss-facebook-method').click(function() {
               var method = $(this).val();
               if (method === '1') {
                    $('.apss-facebook-method-1').show();
                    $('.apss-facebook-method-2').hide();
               } else {
                    $('.apss-facebook-method-2').show();
                    $('.apss-facebook-method-1').hide();
               }
          });


     });
}(jQuery));

function fbrev_init(data) {

     var el = document.querySelector('#' + data.widgetId);
     if (!el)
          return;

     var fbConnectBtn = el.querySelector('#apsc_fb_connect');
     WPacFastjs.on(fbConnectBtn, 'click', function() {
          fbrev_connect(el, data);
          return false;
     });
}

function fbrev_connect(el, data) {

     fbrev_popup('https://app.widgetpack.com/auth/fbrev?scope=manage_pages,pages_show_list', 670, 520, function() {
          WPacXDM.get('https://embed.widgetpack.com', 'https://app.widgetpack.com/widget/facebook/accesstoken', {}, function(res) {
               WPacFastjs.jsonp('https://graph.facebook.com/me/accounts', {access_token: res.accessToken, limit: 250}, function(res) {

                    var pagesEl = el.querySelector('.apsc-fb-pages-list'),
                    idEl = el.querySelector('.apsc-page-id'),
                    nameEl = el.querySelector('.apsc-page-name'),
                    tokenEl = el.querySelector('.apsc-page-token');

                    WPacFastjs.each(res.data, function(page) {

                         var pageEL = WPacFastjs.create('div', 'apsc-page');
                         pageEL.innerHTML = '<img src="https://graph.facebook.com/' + page.id + '/picture" class="apsc-page-photo">' +
                         '<div class="apsc-page-name">' + page.name + '</div>';
                         pagesEl.appendChild(pageEL);

                         WPacFastjs.on(pageEL, 'click', function() {
                              idEl.value = page.id;
                              nameEl.value = page.name;
                              tokenEl.value = page.access_token;
                              jQuery(tokenEl).change();

                              WPacFastjs.remcl(pagesEl.querySelector('.active'), 'active');
                              WPacFastjs.addcl(pageEL, 'active');

                              data.cb && data.cb();
                              return false;
                         });
                    });
               });
          });
     });
     return false;
}

function fbrev_popup(url, width, height, cb) {
     var top = top || (screen.height / 2) - (height / 2),
     left = left || (screen.width / 2) - (width / 2),
     win = window.open(url, '', 'location=1,status=1,resizable=yes,width=' + width + ',height=' + height + ',top=' + top + ',left=' + left);
     function check() {
          if (!win || win.closed !== false) {
               cb();
          } else {
               setTimeout(check, 100);
          }
     }
     setTimeout(check, 100);
}