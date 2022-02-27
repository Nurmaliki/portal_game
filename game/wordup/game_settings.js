// URL for the word verification
var url = 'http://1html5platform.com/wordgames/';

// Animation waiting player
var arrAnimWait = [
    'angry',
    'cry'/*,
    'sick',
    'sleep',
    'train'*/
];

// Animation when the correct word
var arrAnimHappy = [
    'happy',
    'gift'
];

// Stand animation
var arrAnimStand = [
    'stand'/*,
    'eat',
    'drink',
    'medication',
    'shower',
    'tothbrush'*/
];

//
var waitPlayerInSecond = 15;

// Game field size
var lettersCount = 63;
// Rows on game field
var countLetterRow = 7;
// Columns on game field
var countLetterColumns = 9;

//
costShuffle = 100;

//
var minLengthWord = 2;
var minLengthWordForCombo = 3;

// Game locale
var arrLangs = [
    'en',
    'de',
    'it',
    'pt',
    'fr',
    'es'
];

// Letters Joker
var letterJoker = {
    symbol: '*',
    points: 2
};

// Letters and points
var letters = {
    de:
    [
        { vowels: 6, base: 26, percentIntervalLetters: [45, 50, 5] },
        // vowels
        { symbol: 'A', name: 'A', points: 1 },
        { symbol: 'E', name: 'E', points: 1 },
        { symbol: 'I', name: 'I', points: 1 },
        { symbol: 'O', name: 'O', points: 1 },
        { symbol: 'U', name: 'U', points: 1 },
        { symbol: 'Y', name: 'Y', points: 1 },
        // consonant
        { symbol: 'B', name: 'B', points: 2 },
        { symbol: 'C', name: 'C', points: 2 },
        { symbol: 'D', name: 'D', points: 2 },
        { symbol: 'F', name: 'F', points: 2 },
        { symbol: 'G', name: 'G', points: 3 },
        { symbol: 'H', name: 'H', points: 3 },
        { symbol: 'J', name: 'J', points: 3 },
        { symbol: 'K', name: 'K', points: 3 },
        { symbol: 'L', name: 'L', points: 3 },
        { symbol: 'M', name: 'M', points: 4 },
        { symbol: 'N', name: 'N', points: 4 },
        { symbol: 'P', name: 'P', points: 4 },
        { symbol: 'Q', name: 'Q', points: 5 },
        { symbol: 'R', name: 'R', points: 4 },
        { symbol: 'S', name: 'S', points: 4 },
        { symbol: 'T', name: 'T', points: 4 },
        { symbol: 'V', name: 'V', points: 5 },
        { symbol: 'W', name: 'W', points: 2 },
        { symbol: 'X', name: 'X', points: 5 },
        { symbol: 'Z', name: 'Z', points: 5 }, //26
        //additional
        { symbol: 'Ä', name: 'A2', points: 5 },
        { symbol: 'É', name: 'E2', points: 5 },
        { symbol: 'Ö', name: 'O2', points: 5 },
        { symbol: 'ß', name: 'S2', points: 5 },
        { symbol: 'Ü', name: 'U2', points: 5 }
    ],

    en:
    [
        { vowels: 6, base: 26, percentIntervalLetters: [45, 55, 0] },
        // vowels
        { symbol: 'A', name: 'A', points: 1 },
        { symbol: 'E', name: 'E', points: 1 },
        { symbol: 'I', name: 'I', points: 1 },
        { symbol: 'O', name: 'O', points: 1 },
        { symbol: 'U', name: 'U', points: 1 },
        { symbol: 'Y', name: 'Y', points: 1 },
        // consonant
        { symbol: 'B', name: 'B', points: 2 },
        { symbol: 'C', name: 'C', points: 2 },
        { symbol: 'D', name: 'D', points: 2 },
        { symbol: 'F', name: 'F', points: 2 },
        { symbol: 'G', name: 'G', points: 3 },
        { symbol: 'H', name: 'H', points: 3 },
        { symbol: 'J', name: 'J', points: 3 },
        { symbol: 'K', name: 'K', points: 3 },
        { symbol: 'L', name: 'L', points: 3 },
        { symbol: 'M', name: 'M', points: 4 },
        { symbol: 'N', name: 'N', points: 4 },
        { symbol: 'P', name: 'P', points: 4 },
        { symbol: 'Q', name: 'Q', points: 5 },
        { symbol: 'R', name: 'R', points: 4 },
        { symbol: 'S', name: 'S', points: 4 },
        { symbol: 'T', name: 'T', points: 4 },
        { symbol: 'V', name: 'V', points: 5 },
        { symbol: 'W', name: 'W', points: 2 },
        { symbol: 'X', name: 'X', points: 5 },
        { symbol: 'Z', name: 'Z', points: 5 }
        //additional
    ],

    es:
    [
        { vowels: 6, base: 27, percentIntervalLetters: [45, 50, 5] },
        // vowels
        { symbol: 'A', name: 'A', points: 1 },
        { symbol: 'E', name: 'E', points: 1 },
        { symbol: 'I', name: 'I', points: 1 },
        { symbol: 'O', name: 'O', points: 1 },
        { symbol: 'U', name: 'U', points: 1 },
        { symbol: 'Y', name: 'Y', points: 1 },
        // consonant
        { symbol: 'B', name: 'B', points: 2 },
        { symbol: 'C', name: 'C', points: 2 },
        { symbol: 'D', name: 'D', points: 2 },
        { symbol: 'F', name: 'F', points: 2 },
        { symbol: 'G', name: 'G', points: 3 },
        { symbol: 'H', name: 'H', points: 3 },
        { symbol: 'J', name: 'J', points: 3 },
        { symbol: 'K', name: 'K', points: 3 },
        { symbol: 'L', name: 'L', points: 3 },
        { symbol: 'M', name: 'M', points: 4 },
        { symbol: 'N', name: 'N', points: 4 },
        { symbol: 'Ñ', name: 'N2', points: 5 },
        { symbol: 'P', name: 'P', points: 4 },
        { symbol: 'Q', name: 'Q', points: 5 },
        { symbol: 'R', name: 'R', points: 4 },
        { symbol: 'S', name: 'S', points: 4 },
        { symbol: 'T', name: 'T', points: 4 },
        { symbol: 'V', name: 'V', points: 5 },
        { symbol: 'W', name: 'W', points: 2 },
        { symbol: 'X', name: 'X', points: 5 },
        { symbol: 'Z', name: 'Z', points: 5 },
        //additional
        { symbol: 'Á', name: 'A2', points: 5 },
        { symbol: 'É', name: 'E2', points: 5 },
        { symbol: 'Í', name: 'I2', points: 5 },
        { symbol: 'Ó', name: 'O2', points: 5 },
        { symbol: 'Ú', name: 'U2', points: 5 },
        { symbol: 'Ü', name: 'U3', points: 5 }
    ],

    fr:
    [
        { vowels: 6, base: 26, percentIntervalLetters: [45, 50, 5] },
        // vowels
        { symbol: 'A', name: 'A', points: 1 },
        { symbol: 'E', name: 'E', points: 1 },
        { symbol: 'I', name: 'I', points: 1 },
        { symbol: 'O', name: 'O', points: 1 },
        { symbol: 'U', name: 'U', points: 1 },
        { symbol: 'Y', name: 'Y', points: 1 },
        // consonant
        { symbol: 'B', name: 'B', points: 2 },
        { symbol: 'C', name: 'C', points: 2 },
        { symbol: 'D', name: 'D', points: 2 },
        { symbol: 'F', name: 'F', points: 2 },
        { symbol: 'G', name: 'G', points: 3 },
        { symbol: 'H', name: 'H', points: 3 },
        { symbol: 'J', name: 'J', points: 3 },
        { symbol: 'K', name: 'K', points: 3 },
        { symbol: 'L', name: 'L', points: 3 },
        { symbol: 'M', name: 'M', points: 4 },
        { symbol: 'N', name: 'N', points: 4 },
        { symbol: 'P', name: 'P', points: 4 },
        { symbol: 'Q', name: 'Q', points: 5 },
        { symbol: 'R', name: 'R', points: 4 },
        { symbol: 'S', name: 'S', points: 4 },
        { symbol: 'T', name: 'T', points: 4 },
        { symbol: 'V', name: 'V', points: 5 },
        { symbol: 'W', name: 'W', points: 2 },
        { symbol: 'X', name: 'X', points: 5 },
        { symbol: 'Z', name: 'Z', points: 5 },
        //additional
        { symbol: 'Â', name: 'A2', points: 5 },
        { symbol: 'À', name: 'A3', points: 5 },
        { symbol: 'É', name: 'E2', points: 5 },
        { symbol: 'Ê', name: 'E3', points: 5 },
        { symbol: 'È', name: 'E4', points: 5 },
        { symbol: 'Ë', name: 'E5', points: 5 },
        { symbol: 'Ï', name: 'I2', points: 5 },
        { symbol: 'Î', name: 'I3', points: 5 },
        { symbol: 'Ô', name: 'O2', points: 5 },
        { symbol: 'Û', name: 'U2', points: 5 },
        { symbol: 'Ù', name: 'U2', points: 5 }
    ],

    it:
    [
        { vowels: 6, base: 26, percentIntervalLetters: [45, 50, 5] },
        // vowels
        { symbol: 'A', name: 'A', points: 1 },
        { symbol: 'E', name: 'E', points: 1 },
        { symbol: 'I', name: 'I', points: 1 },
        { symbol: 'O', name: 'O', points: 1 },
        { symbol: 'U', name: 'U', points: 1 },
        { symbol: 'Y', name: 'Y', points: 1 },
        // consonant
        { symbol: 'B', name: 'B', points: 2 },
        { symbol: 'C', name: 'C', points: 2 },
        { symbol: 'D', name: 'D', points: 2 },
        { symbol: 'F', name: 'F', points: 2 },
        { symbol: 'G', name: 'G', points: 3 },
        { symbol: 'H', name: 'H', points: 3 },
        { symbol: 'J', name: 'J', points: 3 },
        { symbol: 'K', name: 'K', points: 3 },
        { symbol: 'L', name: 'L', points: 3 },
        { symbol: 'M', name: 'M', points: 4 },
        { symbol: 'N', name: 'N', points: 4 },
        { symbol: 'P', name: 'P', points: 4 },
        { symbol: 'Q', name: 'Q', points: 5 },
        { symbol: 'R', name: 'R', points: 4 },
        { symbol: 'S', name: 'S', points: 4 },
        { symbol: 'T', name: 'T', points: 4 },
        { symbol: 'V', name: 'V', points: 5 },
        { symbol: 'W', name: 'W', points: 2 },
        { symbol: 'X', name: 'X', points: 5 },
        { symbol: 'Z', name: 'Z', points: 5 },
        //additional
        { symbol: 'Á', name: 'A2', points: 5 },
        { symbol: 'À', name: 'A3', points: 5 },
        { symbol: 'È', name: 'E2', points: 5 },
        { symbol: 'É', name: 'E3', points: 5 },
        { symbol: 'Ì', name: 'I2', points: 5 },
        { symbol: 'Í', name: 'I3', points: 5 },
        { symbol: 'Ó', name: 'O2', points: 5 },
        { symbol: 'Ò', name: 'O3', points: 5 },
        { symbol: 'Ú', name: 'U2', points: 5 },
        { symbol: 'Ù', name: 'U3', points: 5 }
    ],
//
    pt:
    [
        { vowels: 6, base: 26, percentIntervalLetters: [45, 50, 5] },
        // vowels
        { symbol: 'A', name: 'A', points: 1 },
        { symbol: 'E', name: 'E', points: 1 },
        { symbol: 'I', name: 'I', points: 1 },
        { symbol: 'O', name: 'O', points: 1 },
        { symbol: 'U', name: 'U', points: 1 },
        { symbol: 'Y', name: 'Y', points: 1 },
        // consonant
        { symbol: 'B', name: 'B', points: 2 },
        { symbol: 'C', name: 'C', points: 2 },
        { symbol: 'D', name: 'D', points: 2 },
        { symbol: 'F', name: 'F', points: 2 },
        { symbol: 'G', name: 'G', points: 3 },
        { symbol: 'H', name: 'H', points: 3 },
        { symbol: 'J', name: 'J', points: 3 },
        { symbol: 'K', name: 'K', points: 3 },
        { symbol: 'L', name: 'L', points: 3 },
        { symbol: 'M', name: 'M', points: 4 },
        { symbol: 'N', name: 'N', points: 4 },
        { symbol: 'P', name: 'P', points: 4 },
        { symbol: 'Q', name: 'Q', points: 5 },
        { symbol: 'R', name: 'R', points: 4 },
        { symbol: 'S', name: 'S', points: 4 },
        { symbol: 'T', name: 'T', points: 4 },
        { symbol: 'V', name: 'V', points: 5 },
        { symbol: 'W', name: 'W', points: 2 },
        { symbol: 'X', name: 'X', points: 5 },
        { symbol: 'Z', name: 'Z', points: 5 },
        //additional
        { symbol: 'Â', name: 'A2', points: 5 },
        { symbol: 'Á', name: 'A3', points: 5 },
        { symbol: 'Ã', name: 'A4', points: 5 },
        { symbol: 'À', name: 'A5', points: 5 },
        { symbol: 'Ç', name: 'C2', points: 5 },
        { symbol: 'Ê', name: 'E2', points: 5 },
        { symbol: 'É', name: 'E3', points: 5 },
        { symbol: 'Í', name: 'I2', points: 5 },
        { symbol: 'Ô', name: 'O2', points: 5 },
        { symbol: 'Ó', name: 'O3', points: 5 },
        { symbol: 'Õ', name: 'O4', points: 5 },
        { symbol: 'Ú', name: 'U2', points: 5 },
        { symbol: 'Ü', name: 'U3', points: 5 }
    ]
};

