var count = document.getElementById("count").value;

var div = document.getElementById("appendGames");

for (let i = 0; i < count; i++) {
    let gameLogo = document.creatElement("div");
    gameLogo.class = "gameLogo";
    div.append(gameLogo);
    let name = document.createElement("div");
    name.class = "name";
    div.append(name);
    let creator = document.creatElement("span");
    creator.class = "creator";
    div.append(creator);
    let genre = document.createElement("span");
    genre.class = "genre";
    div.append(genre);
  }

  <div class = "game">
            <div class = "gameLogo"></div>
            <span class = "name"></span>
            <span class = "creator"></span>
            <span class = "genre"></span>
        </div>