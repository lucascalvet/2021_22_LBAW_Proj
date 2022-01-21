function encodeForAjax(data) {
    if (data == null) return null;
    return Object.keys(data).map(function(k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
}

function sendAjaxRequest(method, url, data, handler) {
    let request = new XMLHttpRequest();

    request.open(method, url, true);
    request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.addEventListener('load', handler);
    request.send(encodeForAjax(data));
}

/**
 * Likes
 */
function addLikeListeners() {
    let like_buttons = document.getElementsByClassName('button-content-like');

    for (let i = 0; i < like_buttons.length; i++) {

        like_buttons[i].addEventListener('click', () => {
            let idStr = like_buttons[i].id;
            let parsedId = idStr.replace('button-content-like-', '');

            const count = document.getElementById('s-hearts-count-' + parsedId);
            const but = document.getElementById('button-content-like-' + parsedId);
            const liked = but.lastElementChild.classList.contains('bi-heart');
            const icon = but.lastElementChild;

            //changes icon instantaneously when user clicks in icon
            toggleLikeIcon(icon, liked);

            //changes number of likes instantaneously when user clicks in icon
            if (liked) count.innerHTML = parseFloat(count.innerHTML) + 1;
            else count.innerHTML = parseFloat(count.innerHTML) - 1;


            sendAjaxRequest('post', '/content' + '/like/' + parsedId, null, likeResponseHandler);
        });
    }
}

function likeResponseHandler() {
    console.log(this.responseText);
    let res = JSON.parse(this.responseText);

    //failsafe changes for icon and number of likes after the request is processed
    const count = document.getElementById('s-hearts-count-' + res.id);
    count.innerHTML = res.nLikes;

    const but = document.getElementById('button-content-like-' + res.id);
    const icon = but.lastElementChild;

    toggleLikeIcon(icon, res.liked);
}

function toggleLikeIcon(icon, liked) {
    if (liked) {
        icon.classList.add("bi-heart-fill");
        icon.classList.remove("bi-heart");
    } else {
        icon.classList.remove("bi-heart-fill");
        icon.classList.add("bi-heart");
    }
}

addLikeListeners();

/**
 * Friends
 */
// Remove friend on friends list
function addRemoveFriendListeners() {
    let remove_buttons = document.getElementsByClassName('a-remove-friend');

    for (let i = 0; i < remove_buttons.length; i++) {
        let idStr = remove_buttons[i].id;
        let parsedId = idStr.replace('a-remove-friend-', '');

        remove_buttons[i].addEventListener('click', () => {
            updateFriendsCount();
            removeFriendFromList(parsedId);
            sendAjaxRequest('post', '/profile/' + parsedId + '/friendRemove', null, null);
        });
    }
}

function removeFriendFromList(id) {
    let button = document.getElementById('a-remove-friend-' + id);
    button.classList.add("d-none");
    let div = document.getElementById("a-remove-friend-div-" + id);
    div.classList.add("d-none");
}

addRemoveFriendListeners();

//Remove friend on friend profile
function addRemoveFriendOnProfileListeners() {
    let remove_buttons = document.getElementsByClassName('remove-friend');

    for (let i = 0; i < remove_buttons.length; i++) {
        let idStr = remove_buttons[i].id;
        let parsedId = idStr.replace('remove-friend-', '');

        remove_buttons[i].addEventListener('click', () => {
            updateFriendsCount();
            removeRemoveFriendButtonOnProfile(parsedId);

            sendAjaxRequest('post', '/profile/' + parsedId + '/friendRemove', null, removeFriendOnProfileHandler);
        });
    }
}

function removeFriendOnProfileHandler() {
    console.log(this.responseText);
    let res = JSON.parse(this.responseText);
    let div = document.getElementById("a-remove-friend-div-" + res.auth_id);
    div.classList.add("d-none");
}

function removeRemoveFriendButtonOnProfile(id) {
    let remove_button = document.getElementById('remove-friend-' + id);
    remove_button.classList.add("d-none");

    //creating add friend button dynamically
    const a = document.createElement("a");
    a.classList.add('a-add-friend');
    a.id = "a-add-friend-" + id;

    const but = document.createElement("button");
    but.classList.add('btn');
    but.classList.add('btn-secondary');
    but.innerHTML = "Add Friend";

    const addDiv = document.getElementById("d-friend-request");
    console.log(addDiv);
    console.log(a);
    addDiv.appendChild(a);
    a.appendChild(but);

    addFriendRequestButtonListeners(); //could be adding only one new listener
}

addRemoveFriendOnProfileListeners();

//Add friend on friend profile
function addFriendRequestButtonListeners() {
    let remove_buttons = document.getElementsByClassName('a-add-friend');

    for (let i = 0; i < remove_buttons.length; i++) {
        let idStr = remove_buttons[i].id;
        let parsedId = idStr.replace('a-add-friend-', '');

        remove_buttons[i].addEventListener('click', () => {
            removeAddFriendButton(parsedId);
            sendAjaxRequest('post', '/profile/' + parsedId + '/friendRequest', null, null);
        });
    }
}

function removeAddFriendButton(id){
  let add_button = document.getElementById('a-add-friend-' + id);
  add_button.remove();

  //creating add friend button dynamically
  const a = document.createElement("a");
  a.classList.add('a-cancel-friend');
  a.id = "a-cancel-friend-" + id;

  const but = document.createElement("button");
  but.classList.add('btn');
  but.classList.add('btn-secondary');
  but.innerHTML = "Cancel Friend Request";

  const addDiv = document.getElementById("d-friend-request");
  console.log(addDiv);
  console.log(a);
  addDiv.appendChild(a);
  a.appendChild(but);

  addCancelRequestButtonListeners();  //could be adding only one new listener

}

addFriendRequestButtonListeners();

function updateFriendsCount() {
    let friendsCount = document.getElementById("strong-friends-count");
    if (friendsCount.innerHTML != 0) friendsCount.innerHTML = friendsCount.innerHTML - 1;
}



function addCancelRequestButtonListeners(){
  let cancel_buttons = document.getElementsByClassName('a-cancel-friend');

  for(let i = 0; i < cancel_buttons.length; i++){
    let idStr = cancel_buttons[i].id;
    let parsedId = idStr.replace('a-cancel-friend-', '');

    cancel_buttons[i].addEventListener('click', () => {
      removeCancelFriendButton(parsedId);
      sendAjaxRequest('post', '/profile/' + parsedId + '/cancelFriendRequest', null, null);
    });
  }
}

addCancelRequestButtonListeners();

function removeCancelFriendButton(id){
  let cancel_button = document.getElementById('a-cancel-friend-' + id);
  cancel_button.remove();

  //creating add friend button dynamically
  const a = document.createElement("a");
  a.classList.add('a-add-friend');
  a.id = "a-add-friend-" + id;

  const but = document.createElement("button");
  but.classList.add('btn');
  but.classList.add('btn-secondary');
  but.innerHTML = "Add Friend";

  const addDiv = document.getElementById("d-friend-request");
  console.log(addDiv);
  console.log(a);
  addDiv.appendChild(a);
  a.appendChild(but);

  addFriendRequestButtonListeners();  //could be adding only one new listener
}
/*
Initialize Bootstrap tooltips
*/
let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
let tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})
