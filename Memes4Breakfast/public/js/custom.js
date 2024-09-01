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
    myAvatar[0].classList.add('selected-avatar');
    
    // Add a click event for each avatar
    allAvatars.forEach(avatar => {
        avatar.addEventListener('click', pickAvatar);
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

document.addEventListener('DOMContentLoaded', function() {

    console.log('DOM fully loaded and parsed');
    loadAvatars();

});
