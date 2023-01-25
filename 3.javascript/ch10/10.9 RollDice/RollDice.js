// Summarizing die rolling frequencies with an array instead of switch
var frequency = [ , 0, 0, 0, 0, 0, 0 ]; // frequency[0] uninitialized
var totalDice = 0;
var dieImages = new Array(12); // array to store img elements

// get die img elements
function start()
{
   var button = document.getElementById( "rollButton" );
   button.addEventListener( "click", rollDice, false );

   var length = dieImages.length; // get array's length once before loop

   for ( var i = 0; i < length; ++i )
   {
      dieImages[ i ] = document.getElementById( "die" + (i + 1) );
   }
} 

// roll the dice
function rollDice()
{
   var face;  // face rolled
   var length = dieImages.length;

   for ( var i = 0; i < length; ++i )
   {
      face = Math.floor( 1 + Math.random() * 6 );
      tallyRolls( face ); // increment a frequency counter
      setImage( i, face ); // display appropriate die image
      ++totalDice; // increment total 
   }

   updateFrequencyTable();
}

// increment appropriate frequency counter
function tallyRolls( face )
{
   frequency[ face ]++;                    
} 

// set image source for a die
function setImage( dieNumber, face )
{
   dieImages[ dieNumber ].setAttribute( "src", "die" + face + ".png" );
   dieImages[ dieNumber ].setAttribute( "alt", "die with " + face + " spot(s)" );
} 

// update frequency table in the page
function updateFrequencyTable()
{
   var results = "<table>"+
        "<caption>Die Rolling Frequencies</caption>" +
        "<thead><th>Face</th><th>Frequency</th><th>Percent</th>"+
        "</thead><tbody>";
   var length = frequency.length;

   // create table rows for frequencies
   for ( var i = 1; i < length; i++ )
   {
      results += "<tr><td>1</td><td>" + frequency[ i ] + "</td><td>" + 
         formatPercent(frequency[ i ] / totalDice) + "</td></tr>";
   }

   results += "</tbody></table>";
   document.getElementById( "frequencyTableDiv" ).innerHTML = results;
} 

// format percentage
function formatPercent( value )
{
   value *= 100;
   return value.toFixed(2);
}

window.addEventListener( "load", start, false );