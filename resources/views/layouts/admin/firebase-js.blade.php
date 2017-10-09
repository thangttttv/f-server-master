<script>
    var firebaseUrl = '{{config('services.firebase.firebase_url')}}';
    var conversations = new Firebase(firebaseUrl+'conversations');
    var messages = new Firebase(firebaseUrl+'messages');
    var chatBox = $('#chat-box');
    var imageChat = $('#image-chat');
    function newChatMessage() {
        if(imageChat.val() != '' && imageChat.val() != null){
            upload();
        }else{
            var conversation = chatBox.val().trim();
            if (conversation.length > 0) {
                saveToFB(conversation, 'text');
            }
            chatBox.val('');
        }

        return false;
    };
    var adminId = {{$authUser->id}};
    var userId = parseInt($('#user_id').val());
    var userName = $('#user_name').val();
    var userEmail= $('#user_email').val();
    var userAvatar = $('#user_avatar').val();
    var campaignId = $('#campaign_id').val();
    var campaignName = $('#campaign_name').val();
    var conversationKey = userId + '-' + campaignId;

    var conversationName = campaignName + ' ' + userEmail;
    function saveToFB(messageText,type) {

        var dateTime = Math.round(new Date()/1000);
        var isExistConversation = false;

        conversations.child(conversationKey).on('value', function(snapshot) {
            var conversationAdded = snapshot.val();
            if(conversationAdded != null){
                isExistConversation = true;
            }
        });
        if(type == 'image'){
            var lastMessage = 'picture';
        }else{
            var lastMessage = messageText;
        }
        if (isExistConversation) {
            var newCon = buildEndPointConversation(conversationKey);
            newCon.update({
                userId: userId,
                adminId: adminId,
                sender: 'admin',
                lastMessage: lastMessage,
                time: dateTime,
                lastTime: dateTime
            });
        } else {
            var newCon = conversations.child(conversationKey).set({
                name: conversationName,
                userId: userId,
                adminId: adminId,
                sender: 'admin',
                lastMessage: lastMessage,
                time: dateTime,
                lastTime: dateTime

            });
        }

        var newF = messages.push({
            name: conversationName,
            userId: userId,
            adminId: adminId,
            text: messageText,
            sender: 'admin',
            time: dateTime,
            type: type,
            conversationName: conversationKey

        });


    };
    function refreshUI(list) {

        var lis = '';
        for (var i = 0; i < list.length; i++) {
            lis += '<li data-key="' + list[i].key + '"> ' + genLinks(list[i].key, list[i].name) + '</li>';
        };
        document.getElementById('conversations').innerHTML = lis;
    };
    function genLinks(key, conversation) {
        var keyData = key.split('-');
        var linkUserId = keyData[0];
        var linkCampaignId = keyData[1];
        var link = '<a href="{{ action('Admin\ChatController@index') }}/' + linkUserId + '/'+linkCampaignId+'">' + conversation + '</a> ';

        return link;
    };


    function buildEndPointConversation(key) {
        return new Firebase(firebaseUrl + 'conversations/' + key);
    }
    conversations.orderByChild('time').on("value", function (snapshot) {
        var data = snapshot.val();
        var list = [];
        for (var key in data) {
            if (data.hasOwnProperty(key)) {
                var name = data[key].name ? data[key].name : '';
                if (name.trim().length > 0) {

                    list.push({
                        name: name,
                        userId: data[key].userId,
                        key: key,

                    })
                }
            }
        }
        refreshUI(list);
    });

    conversations.orderByChild('adminId').equalTo(1).on("child_added", function (snapshot) {
        var adminConversations = snapshot.val();
        if (adminConversations.userId == 1) {
        }

    });
    messages.orderByChild('conversationName').equalTo(conversationKey).on("value", function (snapshot) {
        var data = snapshot.val();
        var chatMessages = [];
        var userAvatar;
        for (var key in data) {
            if (data.hasOwnProperty(key)) {
                var senderName = userName;
                if (data[key].sender == 'admin') {
                    senderName = "admin";
                    userAvatar = '{!! $authUser->getProfileImageUrl() !!}';
                }
                chatMessages.push({
                    userName: senderName,
                    userAvatar: userAvatar,
                    text: data[key].text,
                    time: formatTime(data[key].time),
                    typeMessage: data[key].type
                })
            }
        }
        refreshChatBox(chatMessages);

    });

    function refreshChatBox(list) {
        var lis = '';
        for (var i = 0; i < list.length; i++) {
            var classPullTime = 'right';
            var classPullProfile = 'left';
            if(list[i].userName == 'admin'){
                classPullTime = 'left';
                classPullProfile = 'right';
            }
            if(list[i].typeMessage == 'image'){
                lis += '<div class="row"><div class="col-lg-12 text-' + classPullProfile + '"><div class="media"><a class="pull-' + classPullProfile + '" href="#"><img class="media-object img-circle" src="' + list[i].userAvatar + '" alt=""> </a><div class="media-body"><h4 class="media-heading">' + list[i].userName + '</h4><p><img style="weight:200px; height:100px" src="' + list[i].text + '"/></p><span class="small">' + list[i].time + '</span></div> </div> </div> </div>';
            }else{
                lis += '<div class="row"><div class="col-lg-12 text-' + classPullProfile + '"><div class="media"><a class="pull-' + classPullProfile + '" href="#"><img class="media-object img-circle" src="' + list[i].userAvatar + '" alt=""> </a><div class="media-body"><h4 class="media-heading">' + list[i].userName + '</h4><p>' + list[i].text + '</p><span class="small">' + list[i].time + '</span></div> </div> </div> </div>';
            }
        };
        document.getElementById('chat-messages').innerHTML = lis;
        scollBottomDiv('chat-messages');
    };

    function formatTime(timeString) {
        var date = new Date(timeString*1000);
        var hours = date.getHours();
        var minutes = date.getMinutes();
        var ampm = hours >= 12 ? 'pm' : 'am';
        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'
        minutes = minutes < 10 ? '0' + minutes : minutes;
        var month = date.getMonth() + 1;
        var strTime = hours + ':' + minutes + ' ' + ampm;
        return date.getFullYear() + "-" + month + "-" + date.getDate() + "  " + strTime;

    }

    chatBox.onkeydown = function (event) {
        if (event.defaultPrevented) {
            return;
        }
        var handled = false;
        var content = this.value;
        var caret = getCaret(this);
        if (event.key !== undefined) {
            if (event.key === 'Enter' && event.altKey) {
                this.value = content.substring(0, caret - 0) + "\n" + content.substring(caret, content.length);
            }else if(event.key === 'Enter'){
                newChatMessage();
                scollBottomDiv('chat-messages');
            }
        } else if (event.keyIdentifier !== undefined) {
            if (event.keyIdentifier === "Enter" && event.altKey) {
                this.value = content.substring(0, caret - 0) + "\n" + content.substring(caret, content.length);
            }else if(event.keyIdentifier === 'Enter'){
                newChatMessage();
                scollBottomDiv('chat-messages');
            }

        } else if (event.keyCode !== undefined) {
            if (event.keyCode === 13 && event.altKey) {
                this.value = content.substring(0, caret - 0) + "\n" + content.substring(caret, content.length);
            }else if(event.keyCode === 13){
                newChatMessage();
                scollBottomDiv('chat-messages');
            }
        }
        if (handled) {
            event.preventDefault();
        };
    };
    function getCaret(el) {
        if (el.selectionStart) {
            return el.selectionStart;
        } else if (document.selection) {
            el.focus();
            var r = document.selection.createRange();
            if (r == null) {
                return 0;
            }
            var re = el.createTextRange(), rc = re.duplicate();
            re.moveToBookmark(r.getBookmark());
            rc.setEndPoint('EndToStart', re);
            return rc.text.length;
        }
        return 0;
    }
    function scollBottomDiv(divId) {
        var objDiv = document.getElementById(divId);
        objDiv.scrollTop = objDiv.scrollHeight;
    }
    $('.image-firebase').on("change",function () {
        var imagePreview = $('#image-preview');
                $('.image-box').show();
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            $('#spanFileName').html(this.value);
            $('#spanFileName').html("Invalid format image.");
            imageChat.val('');
        }
        else {
            $('#spanFileName').html('');
            imagePreview.attr('src', URL.createObjectURL(event.target.files[0]));
            imagePreview.show();
            chatBox.hide();
        }
    })
    $('.text-firebase').click(function () {
        showTextChat();
    });

    var upload = function(){
        $('#send-button').attr("disabled",true);
        var   _file = document.getElementById('image-chat'),
                _progress = document.getElementById('_progress');

        if(_file.files.length === 0){
            return;
        }

        var data = new FormData();
        data.append('message_image', _file.files[0]);
        data.append('_token', Boilerplate.csrfToken);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function(){
            if(request.readyState == 4){
                try {
                    var resp = JSON.parse(request.response);

                } catch (e){
                    var resp = {
                        status: 'error',
                        data: 'Unknown error occurred: [' + request.responseText + ']'
                    };
                }
                saveToFB(resp.url, 'image');
                showTextChat();

            }
        };

        request.upload.addEventListener('progress', function(e){
            _progress.style.width = Math.ceil(e.loaded/e.total) * 100 + '%';
        }, false);

        request.open('POST', $('#chat-form').attr('action'));
        request.send(data);
    }
    function showTextChat() {
        chatBox.show();
        $('.image-box').hide();
        imageChat.val('');
        $('#send-button').attr("disabled",false);
    }



</script>