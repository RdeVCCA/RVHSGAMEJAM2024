//change color of star when hover
function highlightStar(star_number){
    if (star_number > 0 && star_number < 6){
        for (star_number; star_number > 0; star_number--){
            document.getElementById("Star" + star_number).src = "static/img/ColoredStar.png"
        }
    } else if (star_number > 5 && star_number < 11){
        for (star_number; star_number > 5; star_number--){
            document.getElementById("Star" + star_number).src = "static/img/ColoredStar.png"
        }
    } else if (star_number > 10 && star_number < 16){
        for (star_number; star_number > 10; star_number--){
            document.getElementById("Star" + star_number).src = "static/img/ColoredStar.png"
        }
    } else{
        for (star_number; star_number > 15; star_number--){
            document.getElementById("Star" + star_number).src = "static/img/ColoredStar.png"
        }
    } 
}

var highlighted1 = false
var highlighted2 = false
var highlighted3 = false
var highlighted4 = false
var permanentNumber1 = 0
var permanentNumber2 = 0
var permanentNumber3 = 0
var permanentNumber4 = 0
//change color of star when not hover

function unhighlightStar(star_number){
    if (star_number > 0 && star_number < 6){
        if (highlighted1 == false){
            for (star_number; star_number > 0; star_number--){
                document.getElementById("Star" + star_number).src = "static/img/Star.png"
            }
        } else{
            for (star_number; star_number > permanentNumber1; star_number--){
                document.getElementById("Star" + star_number).src = "static/img/Star.png"
            }
        }
    } else if (star_number > 5 && star_number < 11){
        if (highlighted2 == false){
            for (star_number; star_number > 5; star_number--){
                document.getElementById("Star" + star_number).src = "static/img/Star.png"
            }
        } else{
            for (star_number; star_number > permanentNumber2; star_number--){
                document.getElementById("Star" + star_number).src = "static/img/Star.png"
            }
        }
    } else if (star_number > 10 && star_number < 16){
        if (highlighted3 == false){
            for (star_number; star_number > 10; star_number--){
                document.getElementById("Star" + star_number).src = "static/img/Star.png"
            }
        } else{
            for (star_number; star_number > permanentNumber3; star_number--){
                document.getElementById("Star" + star_number).src = "static/img/Star.png"
            }
        }
    } else{
        if (highlighted4 == false){
            for (star_number; star_number > 15; star_number--){
                document.getElementById("Star" + star_number).src = "static/img/Star.png"
            }
        } else{
            for (star_number; star_number > permanentNumber4; star_number--){
                document.getElementById("Star" + star_number).src = "static/img/Star.png"
            }
        }
    }
}

//change color of star when clicked on
function permanentHighlight(star_number){
    if (star_number > 0 && star_number < 6){
        permanentNumber1 = star_number
        for (let star_number = 5; star_number > 0; star_number--){
            document.getElementById("Star" + star_number).src = "static/img/Star.png"
        }
        for (star_number; star_number > 0; star_number--){
            document.getElementById("Star" + star_number).src = "static/img/ColoredStar.png"
        }
        highlighted1 = true
    } else if (star_number > 5 && star_number < 11){
        permanentNumber2 = star_number
        for (let star_number = 10; star_number > 5; star_number--){
        document.getElementById("Star" + star_number).src = "static/img/Star.png"
        }
        for (star_number; star_number > 5; star_number--){
            document.getElementById("Star" + star_number).src = "static/img/ColoredStar.png"
        }
        highlighted2 = true
    } else if (star_number > 10 && star_number < 16){
        permanentNumber3 = star_number
        for (let star_number = 15; star_number > 10; star_number--){
        document.getElementById("Star" + star_number).src = "static/img/Star.png"
        }
        for (star_number; star_number > 10; star_number--){
            document.getElementById("Star" + star_number).src = "static/img/ColoredStar.png"
        }
        highlighted3 = true
    } else{
        permanentNumber4 = star_number
        for (let star_number = 20; star_number > 15; star_number--){
            document.getElementById("Star" + star_number).src = "static/img/Star.png"
            }
        for (star_number; star_number > 15; star_number--){
            document.getElementById("Star" + star_number).src = "static/img/ColoredStar.png"
        }
        highlighted4 = true
    } 
    
    
    
}

//defining variables
var total_ratings = 0
var number_of_ratings = 0
var average_ratings = 0
var current_ratings = 0
//sets current rating when clicked on star
function calculateRatings(ratings){
    current_ratings = ratings
    number_of_ratings += 1
    average_ratings = (current_ratings / number_of_ratings).toFixed(1)
    console.log(permanentNumber1)
    console.log(permanentNumber2)
    console.log(permanentNumber3)
    console.log(permanentNumber4)
    document.getElementById('currentRatings').value = String(permanentNumber1) + String(permanentNumber2 - 5) + String(permanentNumber3 - 10) + String(permanentNumber4 - 15)
    console.log(document.getElementById('currentRatings').value)
}