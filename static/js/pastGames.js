"use strict";
// to anyone wondering where the variable `pastGames` comes from,
// it comes from
// const pastGames = <?php echo json_encode($pastGame); ?>;
// in home.tpl.php
// and `$pastGame` comes from pastGames.inc.php which loads from a database

const selectYear = document.querySelectorAll('.select-year');
var selectedYear = document.querySelector('.select-year[data-selected="true"]');
var selectedGame;

function updateGameDetails(gameId) {
    const gameDetails = document.querySelector('.game-details-container');
    const description = gameDetails.querySelector('.description');
    const img = gameDetails.querySelector('.game-image');
    const video = gameDetails.querySelector('.game-video');
    const title = gameDetails.querySelector('.game-title');
    const visitButton = gameDetails.querySelector('.game-visit');
    const game = pastGames[selectedYear.innerHTML][gameId];

    description.innerHTML = game.description;
    if (game.video) {
        video.querySelector("source").src = game.video;
        video.load();
        video.style.display = 'block';
        img.style.display = 'none';
    } else {
        img.src = game.thumbnail;
        img.style.display = 'block';
        video.style.display = 'none';
    }
    title.textContent = game.title;
    visitButton.onclick = function() {
        window.open(game.link, '_blank');
    };

}
function gameClick(){
    selectedGame.removeAttribute('data-selected');
    this.setAttribute('data-selected', 'true');
    selectedGame = this;
    updateGameDetails(this.dataset.gameId);
}
function loadGames(year){
    const gamesToLoad = pastGames[year];
    const gameList = document.querySelector('.select-game-container');
    gameList.innerHTML = '';
    var first = true;
    for (var gameId in gamesToLoad) {
        const game = gamesToLoad[gameId];
        const gameButton = document.createElement('input');
        gameButton.type = 'image';
        gameButton.classList.add('select-game');
        if (first){
            gameButton.setAttribute('data-selected', 'true');
            selectedGame = gameButton;
            updateGameDetails(gameId);
            first = false;
        }
        gameButton.src = game.logo;
        gameButton.dataset.gameId = gameId;
        gameButton.addEventListener('click', gameClick);
        gameList.appendChild(gameButton);
    }
}
for (let i = 0; i < selectYear.length; i++) {
    selectYear[i].addEventListener('click', function() {
        selectedYear.removeAttribute('data-selected');
        this.setAttribute('data-selected', 'true');
        selectedYear = this;
        loadGames(this.innerHTML);
    });
}

loadGames(selectedYear.innerHTML);

