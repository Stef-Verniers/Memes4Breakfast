let defaultAvatars;
let premiumAvatars;
let allAvatars = [];

function loadAvatars() {

    defaultAvatars = document.querySelectorAll('#defaults > div');
    premiumAvatars = document.querySelectorAll('#premiums > div');
    currentAvatar = document.getElementsByClassName('currentAvatar')[0].getAttribute('id')

    // Combine the two arrays of avatars
    allAvatars = [...defaultAvatars, ...premiumAvatars];

    let myAvatar = allAvatars.filter((avatar) => avatar.id === currentAvatar);
    console.log(allAvatars)
    myAvatar[0].classList.add('selected-avatar');
    
    // Add a click event for each avatar
    allAvatars.forEach(avatar => {
        if (avatar.classList.contains !== 'disabled') {
            console.log('this avatar is available');
            avatar.addEventListener('click', pickAvatar);
        }
        return;
    });

}

function pickAvatar(event) {

    // remove selected class from all avatars
    allAvatars.forEach(avatar => {
        avatar.classList.remove('selected-avatar');
    });
    
    // Add the selected class to the picked avatar
    event.currentTarget.classList.add('selected-avatar');

    console.log(event.currentTarget)

    // We get the information about the selected
    let selectedAvatarId = event.currentTarget.getAttribute('id');
    console.log("Geselecteerde Avatar: " + selectedAvatarId);

    let myNewAvatar = document.getElementById('newAvatar');
    myNewAvatar.value = selectedAvatarId;
    
}

function likeMeme(event) {
    // Vervolledig de functie om de like buttons te animeren en de meme een state van 'liked' te geven.
    allMemes = document.querySelectorAll('.like-path')
    console.log(allMemes)
    console.log('allMemes')
}

document.addEventListener('DOMContentLoaded', function() {

    console.log('DOM fully loaded and parsed');
    if(window.location == 'http://127.0.0.1:8000/profile') {
        loadAvatars();
    }
    likeMeme();

});
