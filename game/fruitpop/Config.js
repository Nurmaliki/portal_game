config =
{
    appId : '413607935445686',
    fb_post : 10000,
    fb_name: 'Fruit Pop',
    fb_caption: 'Hey!',
    fb_description: 'I am playing Fruit Pop. Come check it out!',
    add_home_post : 500,

    //-----------------------------------------------------------------------------

    destroy_length : 3, // minimal needed friuts for line
    combo: [
    { img : "white_text_good", length : 8}, 
    { img : "white_text_perfect", length : 10}, 
    { img : "white_text_great", length : 12}, 
    { img : "white_text_excellent", length : 14}
    ],

    score_fruit : 10, // points for one fruit


    //--------LEVELS---------------------------------------------------------------------

    levels :
    [
        {  // Level 1
            level : [
                [1,1,1,1,1,0,0,0], // places for fruits
                [1,1,1,1,1,0,0,0],
                [1,1,1,1,1,0,0,0],
                [1,1,1,1,1,0,0,0],
                [1,1,1,1,1,0,0,0],
                [0,0,0,0,0,0,0,0],
                [0,0,0,0,0,0,0,0],
                [0,0,0,0,0,0,0,0]
            ],
            offset : {x:1.5, y:1.5}, // don't cnange - place for game field
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange"], // colors for this level
            score : 2000,   // points requirement
            lock : 0,       // numbers of locks
            block : 0,      // blocks fo clear
            move : 10,      // moves requirement
            pr_2 : 0.5,     // rewards from matrix: 50%   (1-50/100)=0.5
            pr_1 : 0.25     // rewards from matrix: 75%   (1-75/100)=0.25
        },
        { // Level 2
            level : [
                [1,1,1,1,1,0,0,0],
                [1,2,2,2,1,0,0,0],
                [1,2,2,2,1,0,0,0],
                [1,1,1,1,1,0,0,0],
                [1,1,1,1,1,0,0,0],
                [0,0,0,0,0,0,0,0],
                [0,0,0,0,0,0,0,0],
                [0,0,0,0,0,0,0,0]
            ],
            offset : {x:1.5, y:1.5},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange"],
            score : 0,
            lock : 0,
            block : 6,
            move : 20,
            pr_2 : 0.5,
            pr_1 : 0.25
        },
        {
            level : [
                [0,1,1,1,0,0,0,0],
                [1,1,1,1,1,0,0,0],
                [1,1,1,1,1,0,0,0],
                [1,1,1,1,1,0,0,0],
                [1,1,1,1,1,0,0,0],
                [1,1,1,1,1,0,0,0],
                [0,1,1,1,0,0,0,0],
                [0,0,0,0,0,0,0,0]
            ],
            offset : {x:1.5, y:0.5},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red"],
            score : 4000,
            lock : 0,
            block : 0,
            move : 20,
            pr_2 : 0.5,
            pr_1 : 0.25
        },
        {
            level : [
                [0,1,1,1,0,0,0,0],
                [1,1,1,1,1,0,0,0],
                [1,2,2,2,1,0,0,0],
                [1,2,2,2,1,0,0,0],
                [1,2,2,2,1,0,0,0],
                [1,1,1,1,1,0,0,0],
                [0,1,1,1,0,0,0,0],
                [0,0,0,0,0,0,0,0]
            ],
            offset : {x:1.5, y:0.5},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red", "fruit_violet"],
            score : 0,
            lock : 0,
            block : 9,
            move : 20,
            pr_2 : 0.5,
            pr_1 : 0.25
        },
        {
            level : [
                [0,0,1,1,1,0,0,0],
                [0,1,1,1,1,1,0,0],
                [1,1,1,1,1,1,1,0],
                [1,1,1,1,1,1,1,0],
                [1,1,1,1,1,1,1,0],
                [0,1,1,1,1,1,0,0],
                [0,0,1,1,1,0,0,0],
                [0,0,0,0,0,0,0,0]
            ],
            offset : {x:0.5, y:0.5},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red"],
            score : 6000,
            lock : 1,
            block : 0,
            move : 20,
            pr_2 : 0.5,
            pr_1 : 0.25
        },
        {
            level : [
                [0,0,1,1,1,0,0,0],
                [0,1,1,1,1,1,0,0],
                [1,2,2,2,2,2,1,0],
                [1,2,2,2,2,2,1,0],
                [1,2,2,2,2,2,1,0],
                [0,1,1,1,1,1,0,0],
                [0,0,1,1,1,0,0,0],
                [0,0,0,0,0,0,0,0]
            ],
            offset : {x:0.5, y:0.5},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red"],
            score : 7000,
            lock : 0,
            block : 15,
            move : 20,
            pr_2 : 0.5,
            pr_1 : 0.25
        },
        {
            level : [
                [0,0,1,1,1,1,0,0],
                [0,1,1,1,1,1,1,0],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [0,1,1,1,1,1,1,0],
                [0,0,1,1,1,1,0,0],
                [0,0,0,0,0,0,0,0]
            ],
            offset : {x:0, y:0.5},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange"],
            score : 8000,
            lock : 2,
            block : 0,
            move : 20,
            pr_2 : 0.5,
            pr_1 : 0.25
        },
        {
            level : [
                [0,0,1,1,1,1,0,0],
                [0,1,2,2,2,2,1,0],
                [1,1,1,1,1,1,1,1],
                [1,1,2,2,2,2,1,1],
                [1,1,1,1,1,1,1,1],
                [0,1,2,2,2,2,1,0],
                [0,0,1,1,1,1,0,0],
                [0,0,0,0,0,0,0,0]
            ],
            offset : {x:0, y:0.5},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange"],
            score : 0,
            lock : 0,
            block : 12,
            move : 20,
            pr_2 : 0.5,
            pr_1 : 0.25
        },
        {
            level : [
                [0,0,1,1,1,1,0,0],
                [0,1,1,1,1,1,1,0],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [0,1,1,1,1,1,1,0],
                [0,0,1,1,1,1,0,0],
                [0,1,1,1,1,1,1,0]
            ],
            offset : {x:0, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red"],
            score : 9000,
            lock : 0,
            block : 0,
            move : 20,
            pr_2 : 0.5,
            pr_1 : 0.25
        },
        {
            level : [
                [0,0,1,1,1,1,0,0],
                [0,1,1,1,1,1,1,0],
                [1,1,1,2,2,1,1,1],
                [1,1,2,2,2,2,1,1],
                [1,1,1,1,1,1,1,1],
                [0,1,2,2,2,2,1,0],
                [0,0,1,2,2,1,0,0],
                [1,1,1,1,1,1,1,1]
            ],
            offset : {x:0, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red", "fruit_violet"],
            score : 0,
            lock : 1,
            block : 12,
            move : 20,
            pr_2 : 0.5,
            pr_1 : 0.25
        },
        {
            level : [
                [1,1,1,1,1,1,0,0],
                [1,1,1,1,1,1,0,0],
                [1,1,1,1,1,1,0,0],
                [1,1,1,1,1,1,0,0],
                [1,1,1,1,1,1,0,0],
                [1,1,1,1,1,1,0,0],
                [1,1,1,1,1,1,0,0],
                [1,1,1,1,1,1,0,0]
            ],
            offset : {x:1, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red"],
            score : 10000,
            lock : 0,
            block : 0,
            move : 20,
            pr_2 : 0.5,
            pr_1 : 0.25
        },
        {
            level : [
                [1,1,1,1,1,1,0,0],
                [2,2,1,1,2,2,0,0],
                [1,1,2,2,1,1,0,0],
                [1,1,1,1,1,1,0,0],
                [1,1,1,1,1,1,0,0],
                [1,1,2,2,1,1,0,0],
                [2,2,1,1,2,2,0,0],
                [1,1,1,1,1,1,0,0]
            ],
            offset : {x:1, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red"],
            score : 10000,
            lock : 0,
            block : 12,
            move : 20,
            pr_2 : 0.5,
            pr_1 : 0.25
        },
        {
            level : [
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [0,0,0,0,0,0,0,0]
            ],
            offset : {x:0, y:0.5},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red", "fruit_violet", "fruit_yellow"],
            score : 8000,
            lock : 0,
            block : 0,
            move : 30,
            pr_2 : 0.5,
            pr_1 : 0.25
        },
        {
            level : [
                [1,1,1,1,1,1,1,1],
                [1,2,1,2,2,1,2,1],
                [1,1,2,1,1,2,1,1],
                [1,2,1,2,2,1,2,1],
                [1,1,2,1,1,2,1,1],
                [1,2,1,2,2,1,2,1],
                [1,1,1,1,1,1,1,1],
                [0,0,0,0,0,0,0,0]
            ],
            offset : {x:0, y:0.5},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red", "fruit_violet", "fruit_yellow"],
            score : 0,
            lock : 0,
            block : 16,
            move : 30,
            pr_2 : 0.4, // rewards from matrix: 60%   (1-60/100)=0.4
            pr_1 : 0.2  // rewards from matrix: 80%   (1-80/100)=0.2
        },
        {
            level : [
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1]
            ],
            offset : {x:0, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red", "fruit_violet"],
            score : 9000,
            lock : 0,
            block : 0,
            move : 30,
            pr_2 : 0.4, 
            pr_1 : 0.2
        },
        {
            level : [
                [1,1,1,1,1,1,1,1],
                [2,1,1,1,1,1,1,2],
                [1,2,2,1,1,2,2,1],
                [1,1,1,2,2,1,1,1],
                [1,1,1,2,2,1,1,1],
                [1,2,2,1,1,2,2,1],
                [2,1,1,1,1,1,1,2],
                [1,1,1,1,1,1,1,1]
            ],
            offset : {x:0, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red", "fruit_violet", "fruit_yellow"],
            score : 0,
            lock : 0,
            block : 16,
            move : 30,
            pr_2 : 0.4,
            pr_1 : 0.2
        },
        {
            level : [
                [1,1,0,1,1,0,1,1],
                [1,1,1,1,1,1,1,1],
                [0,1,1,1,1,1,1,0],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [0,1,1,1,1,1,1,0],
                [1,1,1,1,1,1,1,1],
                [1,1,0,1,1,0,1,1]
            ],
            offset : {x:0, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red"],
            score : 11000,
            lock : 0,
            block : 0,
            move : 30,
            pr_2 : 0.4,
            pr_1 : 0.2
        },
        {
            level : [
                [2,2,0,1,1,0,2,2],
                [2,2,1,1,1,1,2,2],
                [0,1,1,1,1,1,1,0],
                [1,1,1,2,2,1,1,1],
                [1,1,1,2,2,1,1,1],
                [0,1,1,1,1,1,1,0],
                [2,2,1,1,1,1,2,2],
                [2,2,0,1,1,0,2,2]
            ],
            offset : {x:0, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red"],
            score : 5000,
            lock : 0,
            block : 20,
            move : 30,
            pr_2 : 0.4,
            pr_1 : 0.2
        },
        {
            level : [
                [1,0,1,0,0,1,0,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,0,1,0,0,1,0,1]
            ],
            offset : {x:0, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red"],
            score : 8000,
            lock : 0,
            block : 0,
            move : 30,
            pr_2 : 0.4,
            pr_1 : 0.2
        },
        {
            level : [
                [1,0,1,0,0,1,0,1],
                [1,1,1,1,1,1,1,1],
                [1,2,2,2,2,2,2,1],
                [1,1,2,1,1,2,1,1],
                [1,1,2,1,1,2,1,1],
                [1,2,2,2,2,2,2,1],
                [1,1,1,1,1,1,1,1],
                [1,0,1,0,0,1,0,1]
            ],
            offset : {x:0, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red", "fruit_violet", "fruit_yellow"],
            score : 0,
            lock : 0,
            block : 16,
            move : 30,
            pr_2 : 0.4,
            pr_1 : 0.2
        },
        {
            level : [
                [1,0,1,0,0,1,0,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [0,1,1,1,1,1,1,0],
                [0,1,1,1,1,1,1,0],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,0,1,0,0,1,0,1]
            ],
            offset : {x:0, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red"],
            score : 9000,
            lock : 0,
            block : 0,
            move : 30,
            pr_2 : 0.4,
            pr_1 : 0.2
        },
        {
            level : [
                [1,0,1,0,0,1,0,1],
                [1,2,1,1,1,1,2,1],
                [1,1,2,1,1,2,1,1],
                [0,1,1,2,2,1,1,0],
                [0,1,1,2,2,1,1,0],
                [1,1,2,1,1,2,1,1],
                [1,2,1,1,1,1,2,1],
                [1,0,1,0,0,1,0,1]
            ],
            offset : {x:0, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red", "fruit_violet"],
            score : 0,
            lock : 0,
            block : 12,
            move : 30,
            pr_2 : 0.4,
            pr_1 : 0.2
        },
        {
            level : [
                [1,1,1,1,1,1,1,1],
                [1,0,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,0,1],
                [1,1,1,1,1,1,1,1]
            ],
            offset : {x:0, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red"],
            score : 7500,
            lock : 0,
            block : 0,
            move : 30,
            pr_2 : 0.4,
            pr_1 : 0.2
        },
        {
            level : [
                [1,1,1,1,1,1,1,2],
                [1,0,1,1,1,1,2,1],
                [1,1,1,1,1,2,1,1],
                [1,1,1,1,2,1,1,1],
                [1,1,1,2,1,1,1,1],
                [1,1,2,1,1,1,1,1],
                [1,2,1,1,1,1,0,1],
                [2,1,1,1,1,1,1,1]
            ],
            offset : {x:0, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange"],
            score : 12000,
            lock : 0,
            block : 8,
            move : 30,
            pr_2 : 0.4,
            pr_1 : 0.2
        },
        {
            level : [
                [1,1,1,1,1,1,1,1],
                [1,0,1,1,1,1,0,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,0,1,1,1,1,0,1],
                [1,1,1,1,1,1,1,1]
            ],
            offset : {x:0, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red", "fruit_violet"],
            score : 11000,
            lock : 0,
            block : 0,
            move : 30,
            pr_2 : 0.5,
            pr_1 : 0.25
        },
        {
            level : [
                [1,1,1,1,1,1,1,1],
                [1,0,1,1,1,1,0,1],
                [1,2,1,1,1,1,2,1],
                [1,1,1,2,2,1,1,1],
                [1,1,1,2,2,1,1,1],
                [1,2,1,1,1,1,2,1],
                [1,0,1,1,1,1,0,1],
                [1,1,1,1,1,1,1,1]
            ],
            offset : {x:0, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red"],
            score : 0,
            lock : 0,
            block : 8,
            move : 30,
            pr_2 : 0.5,
            pr_1 : 0.25
        },
        {
            level : [
                [1,1,1,1,1,1,1,1],
                [1,0,1,1,1,1,0,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,0,1,1,1,1,0,1],
                [1,1,1,1,1,1,1,1]
            ],
            offset : {x:0, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red"],
            score : 14000,
            lock : 0,
            block : 0,
            move : 30,
            pr_2 : 0.5,
            pr_1 : 0.25
        },
        {
            level : [
                [1,1,1,1,1,1,1,1],
                [1,0,1,1,1,1,0,1],
                [1,1,2,2,2,2,1,1],
                [1,2,1,1,1,1,2,1],
                [1,2,1,1,1,1,2,1],
                [1,1,2,2,2,2,1,1],
                [1,0,1,1,1,1,0,1],
                [1,1,1,1,1,1,1,1]
            ],
            offset : {x:0, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red", "fruit_violet"],
            score : 0,
            lock : 0,
            block : 12,
            move : 30,
            pr_2 : 0.5,
            pr_1 : 0.25
        },
        {
            level : [
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,0,1,1,0,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,0,1,1,0,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1]
            ],
            offset : {x:0, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red"],
            score : 12500,
            lock : 0,
            block : 0,
            move : 30,
            pr_2 : 0.5,
            pr_1 : 0.25
        },
        {
            level : [
                [1,1,1,1,1,1,1,1],
                [1,2,1,2,2,1,2,1],
                [1,2,0,2,2,0,2,1],
                [1,2,1,2,2,1,2,1],
                [1,2,1,2,2,1,2,1],
                [1,2,0,2,2,0,2,1],
                [1,2,1,2,2,1,2,1],
                [1,1,1,1,1,1,1,1]
            ],
            offset : {x:0, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange"],
            score : 14000,
            lock : 0,
            block : 24,
            move : 30,
            pr_2 : 0.7,
            pr_1 : 0.4
        },
        {
            level : [
                [1,1,1,1,1,1,1,1],
                [1,0,1,1,1,1,0,1],
                [1,1,0,1,1,0,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,0,1,1,0,1,1],
                [1,0,1,1,1,1,0,1],
                [1,1,1,1,1,1,1,1]
            ],
            offset : {x:0, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red"],
            score : 7500,
            lock : 0,
            block : 0,
            move : 30,
            pr_2 : 0.7,
            pr_1 : 0.4
        },
        {
            level : [
                [1,1,1,1,1,1,1,1],
                [1,0,1,1,1,1,0,1],
                [1,1,0,2,2,0,1,1],
                [1,2,2,2,2,2,2,1],
                [1,2,2,2,2,2,2,1],
                [1,1,0,2,2,0,1,1],
                [1,0,1,1,1,1,0,1],
                [1,1,1,1,1,1,1,1]
            ],
            offset : {x:0, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red", "fruit_violet"],
            score : 0,
            lock : 0,
            block : 16,
            move : 30,
            pr_2 : 0.7,
            pr_1 : 0.4
        },
        {
            level : [
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [0,0,1,1,1,1,0,0],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [0,0,1,1,1,1,0,0],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1]
            ],
            offset : {x:0, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red"],
            score : 11500,
            lock : 0,
            block : 0,
            move : 30,
            pr_2 : 0.7,
            pr_1 : 0.4
        },
        {
            level : [
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [0,0,1,1,1,1,0,0],
                [2,1,2,1,2,1,2,1],
                [1,2,1,2,1,2,1,2],
                [0,0,1,1,1,1,0,0],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1]
            ],
            offset : {x:0, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange"],
            score : 0,
            lock : 0,
            block : 8,
            move : 30,
            pr_2 : 0.7,
            pr_1 : 0.4
        },
        {
            level : [
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [0,1,1,1,1,1,1,0],
                [1,1,1,1,1,1,1,1],
                [0,1,0,1,1,0,1,0]
            ],
            offset : {x:0, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red", "fruit_violet"],
            score : 14000,
            lock : 0,
            block : 0,
            move : 30,
            pr_2 : 0.7,
            pr_1 : 0.4
        },
        {
            level : [
                [1,1,1,1,1,1,1,1],
                [1,2,1,2,1,2,1,2],
                [2,1,2,1,2,1,2,1],
                [1,2,1,2,1,2,1,2],
                [2,1,2,1,2,1,2,1],
                [0,1,1,1,1,1,1,0],
                [1,1,1,1,1,1,1,1],
                [0,1,0,1,1,0,1,0]
            ],
            offset : {x:0, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red"],
            score : 16000,
            lock : 0,
            block : 16,
            move : 30,
            pr_2 : 0.7,
            pr_1 : 0.4
        },
        {
            level : [
                [0,1,0,1,1,0,1,0],
                [1,1,1,1,1,1,1,1],
                [0,1,1,1,1,1,1,0],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [0,1,1,1,1,1,1,0],
                [1,1,1,1,1,1,1,1],
                [0,1,0,1,1,0,1,0]
            ],
            offset : {x:0, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red"],
            score : 15000,
            lock : 0,
            block : 0,
            move : 30,
            pr_2 : 0.7,
            pr_1 : 0.4
        },
        {
            level : [
                [0,1,0,1,1,0,1,0],
                [1,1,1,1,1,1,1,1],
                [0,1,1,1,1,1,1,0],
                [2,1,2,1,1,2,1,2],
                [2,1,2,1,1,2,1,2],
                [0,2,1,1,1,1,2,0],
                [1,2,1,1,1,1,2,1],
                [0,1,0,2,2,0,1,0]
            ],
            offset : {x:0, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red", "fruit_violet"],
            score : 0,
            lock : 0,
            block : 14,
            move : 30,
            pr_2 : 0.7,
            pr_1 : 0.4
        },
        {
            level : [
                [0,1,0,1,1,0,1,0],
                [1,1,1,1,1,1,1,1],
                [0,1,1,1,1,1,1,0],
                [1,1,1,0,1,1,1,1],
                [1,1,1,1,0,1,1,1],
                [0,1,1,1,1,1,1,0],
                [1,1,1,1,1,1,1,1],
                [0,1,0,1,1,0,1,0]
            ],
            offset : {x:0, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red"],
            score : 13500,
            lock : 0,
            block : 0,
            move : 30,
            pr_2 : 0.5,
            pr_1 : 0.25
        },
        {
            level : [
                [0,2,0,1,1,0,2,0],
                [2,2,2,1,1,2,2,2],
                [0,2,1,1,1,1,2,0],
                [1,2,1,0,1,1,2,1],
                [1,2,1,1,0,1,2,1],
                [0,1,1,1,1,1,1,0],
                [1,1,1,1,1,1,1,1],
                [0,1,0,1,1,0,1,0]
            ],
            offset : {x:0, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red", "fruit_violet", "fruit_yellow"],
            score : 0,
            lock : 0,
            block : 14,
            move : 30,
            pr_2 : 0.5,
            pr_1 : 0.25
        },
        {
            level : [
                [0,1,0,1,1,0,1,0],
                [1,1,1,1,1,1,1,1],
                [0,1,1,1,1,1,1,0],
                [1,1,1,0,1,1,1,1],
                [1,1,1,1,0,1,1,1],
                [0,1,1,1,1,1,1,0],
                [1,1,1,1,1,1,1,1],
                [0,1,0,1,1,0,1,0]
            ],
            offset : {x:0, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red"],
            score : 17000,
            lock : 0,
            block : 0,
            move : 30,
            pr_2 : 0.5,
            pr_1 : 0.25
        },
        {
            level : [
                [0,1,0,1,1,0,1,0],
                [1,1,1,1,1,1,1,1],
                [0,1,2,1,1,1,1,0],
                [1,1,2,0,2,2,1,1],
                [1,1,2,2,0,2,1,1],
                [0,1,1,1,1,2,1,0],
                [1,1,1,1,1,1,1,1],
                [0,1,0,1,1,0,1,0]
            ],
            offset : {x:0, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange"],
            score : 18000,
            lock : 0,
            block : 8,
            move : 30,
            pr_2 : 0.5,
            pr_1 : 0.25
        },
        {
            level : [
                [1,1,1,1,1,1,1,1],
                [1,0,0,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,0,0,1],
                [1,1,1,1,1,1,1,1]
            ],
            offset : {x:0, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red"],
            score : 19000,
            lock : 0,
            block : 0,
            move : 30,
            pr_2 : 0.5,
            pr_1 : 0.25
        },
        {
            level : [
                [1,1,1,1,1,2,2,2],
                [1,0,0,1,1,2,1,2],
                [1,1,1,1,1,2,2,2],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [2,2,2,1,1,1,1,1],
                [2,1,2,1,1,0,0,1],
                [2,2,2,1,1,1,1,1]
            ],
            offset : {x:0, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red", "fruit_violet", "fruit_yellow"],
            score : 0,
            lock : 0,
            block : 16,
            move : 30,
            pr_2 : 0.5,
            pr_1 : 0.25
        },
        {
            level : [
                [1,1,1,1,1,1,1,1],
                [1,0,0,1,1,1,0,1],
                [1,1,1,1,1,1,0,1],
                [1,1,1,1,1,1,1,1],
                [1,1,1,1,1,1,1,1],
                [1,0,1,1,1,1,1,1],
                [1,0,1,1,1,0,0,1],
                [1,1,1,1,1,1,1,1]
            ],
            offset : {x:0, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange"],
            score : 20000,
            lock : 0,
            block : 0,
            move : 30,
            pr_2 : 0.5,
            pr_1 : 0.25
        },
        {
            level : [
                [1,1,1,1,1,1,1,1],
                [1,0,0,1,1,1,0,1],
                [1,1,1,1,1,1,0,1],
                [1,1,1,1,1,1,1,1],
                [2,2,2,1,1,1,1,1],
                [2,0,2,1,2,2,2,2],
                [2,0,2,1,2,0,0,2],
                [2,2,2,1,2,2,2,2]
            ],
            offset : {x:0, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red", "fruit_violet", "fruit_yellow"],
            score : 0,
            lock : 0,
            block : 20,
            move : 30,
            pr_2 : 0.5,
            pr_1 : 0.25
        },
        {
            level : [
                [1,1,1,1,1,1,1,1],
                [1,0,1,1,1,1,0,1],
                [1,1,0,1,1,0,1,1],
                [1,1,1,0,1,1,1,1],
                [1,1,1,1,0,1,1,1],
                [1,1,0,1,1,0,1,1],
                [1,0,1,1,1,1,0,1],
                [1,1,1,1,1,1,1,1]
            ],
            offset : {x:0, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red"],
            score : 22000,
            lock : 0,
            block : 0,
            move : 30,
            pr_2 : 0.5,
            pr_1 : 0.25
        },
        {
            level : [
                [1,2,1,1,1,1,1,1],
                [2,0,2,1,1,0,0,1],
                [1,2,0,2,1,0,0,1],
                [1,1,2,0,2,1,1,1],
                [1,1,1,2,0,2,1,1],
                [1,0,0,1,2,0,2,1],
                [1,0,0,1,1,2,0,2],
                [1,1,1,1,1,1,2,1]
            ],
            offset : {x:0, y:0},
            fruit_random_mass : ["fruit_blue", "fruit_green", "fruit_orange", "fruit_red", "fruit_violet"],
            score : 25000,
            lock : 0,
            block : 14,
            move : 30,
            pr_2 : 0.5,
            pr_1 : 0.25
        }
    ]
};