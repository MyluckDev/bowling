<!DOCTYPE html>
<html>
<head>
	<title>Bowling Score</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			
		});
		var column = 1;
		var turn = 1;
		var total = 0;
		var lastScore = 0;
		var totalScore = 0;
		var firstTurn = 0;
		var secondTurn = 0;
		var flag = true;
		var firstScore = 0;
		var firstPoint = 0;
		function score(id){
			var btnValue = $(id).val();

			$(".btn-score").each(function() {
				var less = 10 - btnValue;

				if (this.value > less && turn == 1 && btnValue != 10) {
					$(this).prop('disabled',true);
					$(this).css('background-color','transparent');
				} else {
					$(this).prop('disabled',false);
					$(this).css('background-color','#38FFD8');
				}
			  });
			
			$.post({
			  url: "back.php",
			  data: {
			    value: btnValue,
			    func: 'score'
			  },
			  success: function(result) {

			  if (flag == true) {
			  	
			  	var score = result;
			    total = parseInt(total) + parseInt(result);

			    if (turn == 1) {
			    	firstPoint = result;
			    }
			    if (column == 10) {
			    	
			    	if (result == 10) {
			    		score = 'X';
			    	}

				    if (turn == 1) {
				    	firstScore = score;
				    	var scoreId = "score-9";
		    			var field = document.getElementById(scoreId);
		    			var preValue = $(field).html();
		    			field.innerHTML = parseInt(preValue) + parseInt(result);
				    }
				    if (turn == 2) {
				    	var scoreId = "score-9";
		    			var field = document.getElementById(scoreId);
		    			var preValue = $(field).html();
		    			field.innerHTML = parseInt(preValue) + parseInt(result);
				    	if (firstScore == 'X') {
				    		flag = true;
				    	}else{
				    		var scoreId = "score-9";
			    			var field = document.getElementById(scoreId);
			    			var preValue = $(field).html();
			    			
			    			field.innerHTML = parseInt(preValue) + parseInt(result);

			    			var field = document.getElementById(scoreId);
			    			var preValue = $(field).html();

			    			var scoreId = "score-10";
			    			var field = document.getElementById(scoreId);
			    			field.innerHTML = parseInt(preValue) + parseInt(total);
				    		flag = false;
				    		var field = document.getElementById('total-score');
			    			field.innerHTML = parseInt(preValue) + parseInt(total);

				    	}
				    }
				    if (turn == 3) {
				    	flag = false;
				    	var scoreId = "score-9";
		    			var field = document.getElementById(scoreId);
		    			var preValue = $(field).html();
		    			field.innerHTML = parseInt(preValue) + parseInt(result);

		    			var field = document.getElementById(scoreId);
			    		var preValue = $(field).html();

		    			var scoreId = "score-10";
		    			var field = document.getElementById(scoreId);
		    			field.innerHTML = parseInt(preValue) + parseInt(total);
		    			var field = document.getElementById('total-score');
			    		field.innerHTML = parseInt(preValue) + parseInt(total);
				    }

			    	var textId = "text-"+column+"-"+turn;
				    var field = document.getElementById(textId);
				    field.innerHTML = score;
				    turn = turn + 1;
			    }else{
			    	if (result == 10 && turn == 1) {
				    	score = 'X'
				    	turn = 2;
				    }else{
				    	if (total == 10) {
				    		score = '/';
				    	} 
				    	if (result == 0) {
				    		score = '--'
				    	}
				    }

				    if (turn == 1) {
				    	firstTurn = result;
				    }
				    
				    var textId = "text-"+column+"-"+turn;
				    var field = document.getElementById(textId);
				    field.innerHTML = score;

				    var hiddenId = "points-"+column;
			    	var hiddenfield = document.getElementById(hiddenId);
			    	
			    	if (score == '/') {
			    		hiddenfield.innerHTML = score;
			    	} else {
			    		hiddenfield.innerHTML = total
			    	}
			    	
			    	if (turn >= 2 || result == 10) {

				    	if (lastScore == 'X') {
				    	// strike
				    		if (score == 'X') {

					    		if (column >= 3) {

					    			var firstStrike = false;
					    			var secondStrike = 0;

					    			var lastColumn = column - 2;
					    			var hiddenId = "points-"+lastColumn;
				    				var hiddenfield = document.getElementById(hiddenId);
				    				var prePoints = $(hiddenfield).html();
				    				
						    		if (prePoints == 10) {
						    			
						    			var lastColumn = column - 2;
						    			var scoreId = "score-"+lastColumn;
						    			var field = document.getElementById(scoreId);
						    			var preValue = $(field).html();
						    			
						    			field.innerHTML = parseInt(preValue) + parseInt(firstPoint);

						    			var field = document.getElementById(scoreId);
						    			var preValue = $(field).html();

						    			var lastColumn = column - 1;
						    			var scoreId = "score-"+lastColumn;
						    			var field = document.getElementById(scoreId);
						    			var preValue = $(field).html();
						    			
						    			field.innerHTML = parseInt(preValue) + total + parseInt(firstPoint);
				    				}
						    		
						    		lastColumn = column - 1;
					    			var scoreId = "score-"+lastColumn;
						    		var field = document.getElementById(scoreId);
						    		var preValue = $(field).html();

						    		if (prePoints != 10) {
						    			field.innerHTML = parseInt(preValue) + parseInt(firstPoint);
						    		}

						    		var field = document.getElementById(scoreId);
					    			var preValue = $(field).html();
						  			
									var scoreId = "score-"+column;
						    		var field = document.getElementById(scoreId);
						    		field.innerHTML = parseInt(preValue) + parseInt(result);
					    		} else {
					    			lastColumn = column - 1;
					    			var scoreId = "score-"+lastColumn;
						    		var field = document.getElementById(scoreId);
						    		var preValue = $(field).html();
						    		field.innerHTML = parseInt(preValue) + 10;
						  
									var scoreId = "score-"+column;
						    		var field = document.getElementById(scoreId);
						    		field.innerHTML = 10 + parseInt(preValue) + 10;
					    		}				    		
				    		} else {

				    			var lastColumn = column - 2;
				    			var hiddenId = "points-"+lastColumn;
			    				var hiddenfield = document.getElementById(hiddenId);
			    				var prePoints = $(hiddenfield).html();

					    		if (prePoints == 10) {
					    			
					    			var lastColumn = column - 2;
					    			var scoreId = "score-"+lastColumn;
					    			var field = document.getElementById(scoreId);
					    			var preValue = $(field).html();
					    			
					    			field.innerHTML = parseInt(preValue) + parseInt(firstPoint);

					    			var field = document.getElementById(scoreId);
					    			var preValue = $(field).html();

					    			var lastColumn = column - 1;
					    			var scoreId = "score-"+lastColumn;
					    			var field = document.getElementById(scoreId);
					    			var preValue = $(field).html();
					    			
					    			field.innerHTML = parseInt(preValue) + total + parseInt(firstPoint);
			    				} else {
			    					var lastColumn = column - 1;
					    			var scoreId = "score-"+lastColumn;
					    			var field = document.getElementById(scoreId);
					    			var preValue = $(field).html();
					    			
					    			field.innerHTML = parseInt(preValue) + total;
			    				}
			    				
				    			

				    			var field = document.getElementById(scoreId);
				    			var preValue = $(field).html();
				    			
				    			var scoreId = "score-"+column;
				    			var field = document.getElementById(scoreId);
				    			totalScore = parseInt(preValue) + parseInt(total);
				    			field.innerHTML = totalScore;
				    		}	
				    	} else if (lastScore == '/') {
				    		// when semi strike
				    		
				    		var lastColumn = column - 1;
			    			var scoreId = "score-"+lastColumn;
			    			var field = document.getElementById(scoreId);
			    			var preValue = $(field).html();
			    			
			    			field.innerHTML = parseInt(preValue) + parseInt(firstPoint);

			    			var field = document.getElementById(scoreId);
			    			var preValue = $(field).html();
			    			
			    			var scoreId = "score-"+column;
			    			var field = document.getElementById(scoreId);
			    			totalScore = parseInt(preValue) + parseInt(total);
			    			field.innerHTML = totalScore;
				    	} else {
				    		//natural flow
				    		lastColumn = column - 1;
				    		if (column >= 2) {
				    			var scoreId = "score-"+lastColumn;
					    		var field = document.getElementById(scoreId);
					    		var preValue = $(field).html();
				    		}else{
				    			var preValue = 0;
				    		}

				    		var scoreId = "score-"+column;
				    		var field = document.getElementById(scoreId);
				    		field.innerHTML = parseInt(preValue) + total;
				    	}
				    	lastScore = score;
				    }
			    }
			    
			    if (column == 10) {
			    	turn = turn;
			    }else{
			    	if (score == 'X') {
				    	turn = 1;
				    	column = column + 1;
				    	total = 0;
				    } else {
				    	if (turn == 2) {
				    		turn = 1
				    		column = column + 1;
				    		total = 0;
				    	} else {
				    		turn = turn + 1;
				    	}
				    }
			    }
			   }
			    
			  }
			});
		}

		function newGame(){
			$.post({
			  url: "back.php",
			  data: {
			    value: true,
			    func: 'newgame',
			  },
			  success: function(result) {
			  	// console.log(result);
			  }
			});
			location.reload();
		}
		
	</script>
</head>
<body style="background: url('image.jpg') no-repeat center top;background-size: cover;
    background-repeat: no-repeat; background-position: 50% 0%; width: 100%; height: 100%;">
	<div class="container" style="background-color: rgb(0,0,0,.7); margin-top: 200px;">
		<div class="row">
			<div class="col-xs-12" style="margin-top: 10px; margin-left: 100px;">
				<div class="row">
					<?php for ($i=0; $i < 9; $i++) { ?>
						<div class="col-xs-1" style="margin-right: -28px;">	
							<table>
								<tr style="border: solid 1px; border-color: #9FBADD;">
									<td colspan="2" style="color: #fffb00;">
										<center><b><?php echo $i + 1; ?></b></center>	
									</td>
								</tr>
								<tr style="height: 50px;">
									<td style="width: 52%; border-left: solid 1px; border-color: #9FBADD;">
										<p id="text-<?php echo $i + 1; ?>-1" style="margin-left: 13px; font-size: 17px; color: #fff;"></p>
									</td>
									<td style="width: 50%; border: solid 1px; border-color: #9FBADD;">
										<p id="text-<?php echo $i + 1; ?>-2" style="margin-left: 13px; font-size: 17px; color: #fff;"></p>
									</td>
								</tr>
								<tr style="height: 50px;">
									<td colspan="2" style="width: 100px; border-left: solid 1px; border-right: solid 1px; border-bottom: solid 1px; border-color: #9FBADD;">
										<p id="score-<?php echo $i + 1; ?>" style="margin-left: 17px; margin-top: 5px; font-size: 20px; color: #fff;"></p>
									</td>
								</tr>
								<tr style="height: 50px;">
									<td colspan="2" style="width: 50px;"">
										
										<p style="" id="points-<?php echo $i + 1; ?>"></p>
									</td>
								</tr>
							</table>
						</div>	
					<?php } ?>
						<div class="col-xs-1" style="margin-right: -28px; width: 140px;">	
							<table>
								<tr style="border: solid 1px; border-color: #9FBADD;">
									<td colspan="3"  style="color: #fffb00;">
										<center>10</center>	
									</td>
								</tr>
								<tr style="height: 50px;">
									<td style="width: 50px; border-left: solid 1px; border-color: #9FBADD;">
										<p id="text-10-1" style="margin-left: 13px; font-size: 17px; color: #fff;"></p>
									</td>
									<td style="width: 50px; border: solid 1px; border-color: #9FBADD;">
										<p id="text-10-2" style="margin-left: 13px; font-size: 17px; color: #fff;"></p>
									</td>
									<td style="width: 50px; border: solid 1px; border-color: #9FBADD;">
										<p id="text-10-3" style="margin-left: 13px; font-size: 17px; color: #fff;"></p>
									</td>
								</tr>
								<tr style="height: 50px;">
									<td colspan="3" style="width: 100px; border-left: solid 1px; border-right: solid 1px; border-bottom: solid 1px; border-color: #9FBADD;">
										<p id="score-10" style="margin-left: 17px; margin-top: 5px; font-size: 20px; color: #fff;"></p>
									</td>
								</tr>
							</table>
						</div>
						<div class="col-xs-1" style="border: solid 1px; border-color: #9FBADD; height: 122px; margin-left: 57px;">
							<p id="total-score" style="font-size: 40px; padding-top: 36px; color: #fff;"></p>
						</div>
				</div>
			</div>
		</div>
		<br>
		<div class="col-xs-12">
			<?php for ($i=0; $i < 11; $i++) { ?>
				<div class="col-xs-3" style="margin-right: -40px;">
				<button id="btn<?php echo $i; ?>" class="btn-score" value="<?php echo $i; ?>" style="width: 135px; height: 40px; margin-bottom: 10px; background-color: #38FFD8; color: #2F2353; font-size: 25px;" onclick="score(this);"><b><?php echo $i; ?></b></button>
				</div>
			<?php } ?>
			<div class="col-xs-2">
				<button style="width: 135px; height: 40px; margin-bottom: 10px; background-color: #50F915;" onclick="newGame();"><b>New Game</b></button>
			</div>
		</div>
	</div>
</body>
</html>