config  = {
    add_home_post : 100,              // times for show "Add to Homescreen-new"
    fb_post : 10000,                   // times for show "Share on facebook" (shouldn't a comma at end)
    appId : '315429588615022',      // app id from https://developers.facebook.com/
    fb_name: 'Farm Pets',          // for share on facebook
    fb_caption: 'Hey!',
    fb_description: 'I am playing Farm Pets. Come check it out!',



    speed : 16,
    NUMBER_PETS : 3,       // numbers of same items for match
    water_pr : 0.1,

//-----------FROM-MATRIX------------------------------------------------------------------
    lvls :
        [
            {   // start config for level 1
                moves : 10,             // numbers of moves 
                pets : 3,               // numbers of pets displayed
                job_pets : [7, 7],      // pets requirement
                watermelon : 0,
                pumpkin : 0,
                locks : 0,
                gifts : 0,
                hearts : 0,
                max : 500               // points for 3 corn award system
            },         // end level 1

            {   // start config for level 2
                moves : 20,
                pets : 3,
                job_pets : [15, 15],
                watermelon : 0,
                pumpkin : 0,
                locks : 0,
                gifts : 0,
                hearts : 1,
                max : 500
            },         // 2
            {
                moves : 15,
                pets : 4,
                job_pets : [10, 15, 25],
                watermelon : 1,
                pumpkin : 0,
                locks : 0,
                gifts : 2,
                hearts : 0,
                max : 500
            },         // 3
            {
                moves : 20,
                pets : 5,
                job_pets : [10, 15, 25],
                watermelon : 0,
                pumpkin : 0,
                locks : 0,
                gifts : 0,
                hearts : 1,
                max : 500
            },         // 4
            {
                moves : 20,
                pets : 5,
                job_pets : [20, 15, 25],
                watermelon : 0,
                pumpkin : 0,
                locks : 1,
                gifts : 1,
                hearts : 0,
                max : 500
            },         // 5
            {
                moves : 20,
                pets : 5,
                job_pets : [10, 15, 25],
                watermelon : 0,
                pumpkin : 1,
                locks : 1,
                gifts : 0,
                hearts : 1,
                max : 500
            },         // 6
            {
                moves : 10,
                pets : 5,
                job_pets : [10, 15, 25],
                watermelon : 0,
                pumpkin : 0,
                locks : 0,
                gifts : 1,
                hearts : 0,
                max : 500
            },         // 7

            {   // BONUS LEVEL
                bonus_lvl : 60,     // second for bonus level
                moves : 0,
                pets : 4,
                job_pets : [],      // empty for bonus level
                watermelon : 0,
                pumpkin : 0,
                locks : 0,
                gifts : 0,
                hearts : 0,
                max : 500,
                pt : [30, 20]
            },          // 8
            {
                moves : 15,
                pets : 5,
                job_pets : [10, 15, 25],
                watermelon : 1,
                pumpkin : 0,
                locks : 0,
                gifts : 1,
                hearts : 0,
                max : 500
            },         // 9
            {
                moves : 20,
                pets : 5,
                job_pets : [25, 15, 25],
                watermelon : 0,
                pumpkin : 0,
                locks : 1,
                gifts : 0,
                hearts : 1,
                max : 500
            },         // 10
            {
                moves : 17,
                pets : 5,
                job_pets : [17, 17, 25],
                watermelon : 0,
                pumpkin : 0,
                locks : 0,
                gifts : 1,
                hearts : 0,
                max : 500
            },         // 11
            {
                moves : 22,
                pets : 5,
                job_pets : [17, 25, 25],
                watermelon : 0,
                pumpkin : 1,
                locks : 0,
                gifts : 0,
                hearts : 1,
                max : 500
            },         // 12
            {
                moves : 24,
                pets : 5,
                job_pets : [27, 15, 25],
                watermelon : 0,
                pumpkin : 0,
                locks : 1,
                gifts : 1,
                hearts : 0,
                max : 500
            },         // 13
            {
                moves : 27,
                pets : 5,
                job_pets : [15, 25, 25],
                watermelon : 0,
                pumpkin : 0,
                locks : 2,
                gifts : 0,
                hearts : 1,
                max : 500
            },         // 14
            {
                moves : 18,
                pets : 5,
                job_pets : [22, 15, 25],
                watermelon : 1,
                pumpkin : 0,
                locks : 0,
                gifts : 1,
                hearts : 0,
                max : 500
            },         // 15
            {
                bonus_lvl : 90,
                moves : 0,
                pets : 5,
                job_pets : [],
                watermelon : 0,
                pumpkin : 0,
                locks : 0,
                gifts : 2,
                hearts : 1,
                max : 500,
                pt : [30, 20]
            },         // 16
            {
                moves : 30,
                pets : 5,
                job_pets : [30, 15, 25],
                watermelon : 0,
                pumpkin : 0,
                locks : 0,
                gifts : 1,
                hearts : 0,
                max : 500
            },         // 17
            {
                moves : 20,
                pets : 5,
                job_pets : [20, 25, 25],
                watermelon : 0,
                pumpkin : 1,
                locks : 1,
                gifts : 2,
                hearts : 1,
                max : 500
            },         // 18
            {
                moves : 17,
                pets : 4,
                job_pets : [15, 19, 25],
                watermelon : 0,
                pumpkin : 0,
                locks : 0,
                gifts : 1,
                hearts : 0,
                max : 500
            },         // 19
            {
                moves : 25,
                pets : 5,
                job_pets : [19, 18, 27],
                watermelon : 0,
                pumpkin : 0,
                locks : 0,
                gifts : 0,
                hearts : 2,
                max : 500
            },         // 20
            {
                moves : 20,
                pets : 5,
                job_pets : [25, 15, 25],
                watermelon : 2,
                pumpkin : 0,
                locks : 1,
                gifts : 2,
                hearts : 0,
                max : 500
            },         // 21
            {
                moves : 22,
                pets : 5,
                job_pets : [12, 28, 25],
                watermelon : 0,
                pumpkin : 0,
                locks : 0,
                gifts : 0,
                hearts : 2,
                max : 500
            },         // 22
            {
                moves : 20,
                pets : 5,
                job_pets : [10, 15, 25],
                watermelon : 0,
                pumpkin : 0,
                locks : 1,
                gifts : 2,
                hearts : 0,
                max : 500
            },         // 23
            {
                bonus_lvl : 60,
                moves : 0,
                pets : 6,
                job_pets : [],
                watermelon : 0,
                pumpkin : 0,
                locks : 2,
                gifts : 2,
                hearts : 2,
                max : 500,
                pt : [30, 20]
            },         // 24
            {
                moves : 25,
                pets : 5,
                job_pets : [25, 15, 35],
                watermelon : 0,
                pumpkin : 0,
                locks : 0,
                gifts : 2,
                hearts : 0,
                max : 500
            },         // 25
            {
                moves : 21,
                pets : 5,
                job_pets : [12, 17, 29],
                watermelon : 0,
                pumpkin : 0,
                locks : 1,
                gifts : 0,
                hearts : 2,
                max : 500
            },         // 26
            {
                moves : 22,
                pets : 5,
                job_pets : [14, 18, 25],
                watermelon : 2,
                pumpkin : 0,
                locks : 1,
                gifts : 2,
                hearts : 0,
                max : 500
            },         // 27
            {
                moves : 28,
                pets : 4,
                job_pets : [30, 15, 25],
                watermelon : 0,
                pumpkin : 0,
                locks : 0,
                gifts : 0,
                hearts : 2,
                max : 500
            },         // 28
            {
                moves : 23,
                pets : 5,
                job_pets : [18, 15, 35],
                watermelon : 0,
                pumpkin : 0,
                locks : 1,
                gifts : 2,
                hearts : 0,
                max : 500
            },         // 29
            {
                moves : 18,
                pets : 5,
                job_pets : [18, 19, 20],
                watermelon : 0,
                pumpkin : 2,
                locks : 0,
                gifts : 0,
                hearts : 3,
                max : 500
            },         // 30
            {
                moves : 25,
                pets : 5,
                job_pets : [18, 18, 28],
                watermelon : 0,
                pumpkin : 0,
                locks : 0,
                gifts : 2,
                hearts : 0,
                max : 500
            },         // 31
            {
                bonus_lvl : 90,
                moves : 0,
                pets : 6,
                job_pets : [],
                watermelon : 0,
                pumpkin : 0,
                locks : 0,
                gifts : 1,
                hearts : 2,
                max : 500,
                pt : [30, 20]
            },         // 32
            {
                moves : 25,
                pets : 5,
                job_pets : [15, 25, 25],
                watermelon : 1,
                pumpkin : 0,
                locks : 2,
                gifts : 2,
                hearts : 0,
                max : 500
            },         // 33
            {
                moves : 23,
                pets : 5,
                job_pets : [25, 20, 25],
                watermelon : 0,
                pumpkin : 0,
                locks : 1,
                gifts : 0,
                hearts : 2,
                max : 500
            },         // 34
            {
                moves : 20,
                pets : 5,
                job_pets : [20, 15, 25],
                watermelon : 0,
                pumpkin : 0,
                locks : 0,
                gifts : 2,
                hearts : 0,
                max : 500
            },         // 35
            {
                moves : 20,
                pets : 5,
                job_pets : [10, 15, 25],
                watermelon : 0,
                pumpkin : 2,
                locks : 0,
                gifts : 0,
                hearts : 3,
                max : 500
            },         // 36
            {
                moves : 20,
                pets : 5,
                job_pets : [17, 25, 25],
                watermelon : 0,
                pumpkin : 0,
                locks : 1,
                gifts : 2,
                hearts : 0,
                max : 500
            },         // 37
            {
                moves : 20,
                pets : 4,
                job_pets : [18, 15, 25],
                watermelon : 0,
                pumpkin : 0,
                locks : 0,
                gifts : 0,
                hearts : 1,
                max : 500
            },         // 38
            {
                moves : 20,
                pets : 5,
                job_pets : [17, 15, 25],
                watermelon : 2,
                pumpkin : 0,
                locks : 0,
                gifts : 2,
                hearts : 0,
                max : 500
            },         // 39
            {
                bonus_lvl : 60,
                moves : 0,
                pets : 5,
                job_pets : [],
                watermelon : 0,
                pumpkin : 0,
                locks : 3,
                gifts : 2,
                hearts : 2,
                max : 500,
                pt : [30, 20]
            },         // 40
            {
                moves : 20,
                pets : 5,
                job_pets : [25, 20, 25],
                watermelon : 0,
                pumpkin : 0,
                locks : 2,
                gifts : 2,
                hearts : 0,
                max : 500
            },         // 41
            {
                moves : 20,
                pets : 5,
                job_pets : [15, 25, 25],
                watermelon : 0,
                pumpkin : 1,
                locks : 1,
                gifts : 1,
                hearts : 3,
                max : 500
            },         // 42
            {
                moves : 20,
                pets : 5,
                job_pets : [20, 25, 25],
                watermelon : 0,
                pumpkin : 0,
                locks : 0,
                gifts : 2,
                hearts : 0,
                max : 500
            },         // 43
            {
                moves : 17,
                pets : 5,
                job_pets : [10, 15, 25],
                watermelon : 0,
                pumpkin : 0,
                locks : 3,
                gifts : 0,
                hearts : 1,
                max : 500
            },         // 44
            {
                moves : 18,
                pets : 4,
                job_pets : [10, 15, 25],
                watermelon : 1,
                pumpkin : 0,
                locks : 1,
                gifts : 2,
                hearts : 0,
                max : 500
            },         // 45
            {
                moves : 20,
                pets : 5,
                job_pets : [15, 20, 25],
                watermelon : 0,
                pumpkin : 0,
                locks : 0,
                gifts : 0,
                hearts : 2,
                max : 500
            },         // 46
            {
                moves : 20,
                pets : 5,
                job_pets : [20, 25, 25],
                watermelon : 0,
                pumpkin : 0,
                locks : 0,
                gifts : 2,
                hearts : 0,
                max : 500
            },         // 47
            {
                bonus_lvl : 90,
                moves : 0,
                pets : 6,
                job_pets : [],
                watermelon : 0,
                pumpkin : 0,
                locks : 0,
                gifts : 2,
                hearts : 2,
                max : 500,
                pt : [30, 20]
            }         // 48
        ]
};