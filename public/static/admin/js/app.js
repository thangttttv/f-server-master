var favMovies = new Firebase('https://flare-b0fab.firebaseio.com');
function saveToList(event) {
    if (event.which == 13 || event.keyCode == 13) { // as the user presses the enter key, we will attempt to save the data
        var movieName = document.getElementById('movieName').value.trim();
        if (movieName.length > 0) {
            saveToFB(movieName);
        }
        document.getElementById('movieName').value = '';
        return false;
    }
};
function saveToFB(movieName) {
// this will save data to Firebase
    favMovies.push({
        name: movieName,
        user: {
            name: 'ironhoang2',
            id: 2
        },
        admin: {
            name: 'admin2',
            id: 3
        },
        lastMessage: {
            text: 'hello me',
            time: Date.now()
        }
    });
};
function refreshUI(list) {

    favMovies.child("conversations").orderByChild('name').equalTo('ok').on("child_added", function(snapshot) {
        console.log(snapshot.val());
    });
    var lis = '';
    for (var i = 0; i < list.length; i++) {
        lis += '<li data-key="' + list[i].key + '">' + list[i].name + ' [' + genLinks(list[i].key, list[i].name) + ']</li>';
    }
    ;
    document.getElementById('favMovies').innerHTML = lis;
};
function genLinks(key, mvName) {
    var links = '';
    links += '<a href="javascript:edit(\'' + key + '\',\'' + mvName + '\')">Edit</a> | ';
    links += '<a href="javascript:del(\'' + key + '\',\'' + mvName + '\')">Delete</a>';
    return links;
};
function edit(key, mvName) {
    var movieName = prompt("Update the movie name", mvName); // to keep things simple and old skool :D
    if (movieName && movieName.length > 0) {
// build the FB endpoint to the item in movies collection
        var updateMovieRef = buildEndPoint(key);
        updateMovieRef.update({
            name: movieName
        });
    }
}
function del(key, mvName) {
    var response = confirm("Are certain about removing \"" + mvName + "\" from the list?");
    if (response == true) {
// build the FB endpoint to the item in movies collection
        var deleteMovieRef = buildEndPoint(key);
        deleteMovieRef.remove();
    }
}
function buildEndPoint(key) {
    return new Firebase('https://flare-b0fab.firebaseio.com/messages/' + key);
}
// this will get fired on inital load as well as when ever there is a change in the data
var adminId = 0;
favMovies.on("value", function (snapshot) {
    var data = snapshot.val();
    // console.log(data);
    var list = [];
    for (var key in data) {
        // console.log(key);
        if (data.hasOwnProperty(key)) {
            // console.log(key);
            var fields = key.split('-');

            var clientId = fields[0];
            var myId = fields[1];
            // console.log(clientId);
            // console.log(myId);
            if(adminId == myId){
                // console.log(data[key]);
            }
            name = data[key].name ? data[key].name : '';
            if (name.trim().length > 0) {
                list.push({
                    name: name,
                    key: key
                })
            }
        }
    }
// refresh the UI
    refreshUI(list);
});