$( document ).ready(function() {
    console.log( JSON.stringify(settings) );
});


var settings = {
	"type": 
			{"title": "Тип", 
			"tags": 
				{
					"tip-manualnaia": "Мануальная",
					"type-electrical": "Электрические",
					"type-ultrasonic": "Ультразвуковые"
				}
			},
	"color":
			{"title": "Цвет",
			"tags":
				{
					"color-red": "Красная",
					"color-black": "Черная"
				}
			},
	"manufact":
			{"title": "Производитель",
			"tags":
				{
					"braun-oral-b": "Braun Oral-B"
				}
			}
};