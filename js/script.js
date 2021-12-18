
const visibilityToggle = document.querySelector('.visibility');
const input= document.querySelector('.box-cadastro .input-container input');

var password = true;

if(visibilityToggle){
  visibilityToggle.addEventListener('click', function(){
    if(password){
      input.setAttribute('type', 'text');
      visibilityToggle.innerHTML = 'visibility';
    }else{
        input.setAttribute('type', 'password');
        visibilityToggle.innerHTML = 'visibility_off';
    }

    password = !password;
    
  })
}

const input2= document.querySelector('.box-login .input-container-login input');
var password = true;

if(visibilityToggle){
  visibilityToggle.addEventListener('click', function(){
    if(password){
      input2.setAttribute('type', 'text');
      visibilityToggle.innerHTML = 'visibility';
    }else{
        input2.setAttribute('type', 'password');
        visibilityToggle.innerHTML = 'visibility_off';
    }

    password = !password;
    
  })
}

const input3= document.querySelector('.senha input');
var password = true;

if(visibilityToggle){
  visibilityToggle.addEventListener('click', function(){
    if(password){
      input3.setAttribute('type', 'text');
      visibilityToggle.innerHTML = 'visibility';
    }else{
        input3.setAttribute('type', 'password');
        visibilityToggle.innerHTML = 'visibility_off';
    }

    password = !password;
    
  })
}


function abrirMenu(){
  document.getElementById('nav-menu').style.width="20%";
  document.getElementById('content').style.marginRight="20%";
}

function fecharMenu(){
  document.getElementById('nav-menu').style.width= "0px";
  document.getElementById('content').style.marginRight="0";
}

function abrirMenu_perfil(){
  document.getElementById('nav-menu').style.width="20%";
  document.getElementById('content').style.marginRight="1.5%";
}

function fecharMenu_perfil(){
  document.getElementById('nav-menu').style.width= "0px";
  document.getElementById('content').style.marginRight="0";
}

var botao_info=0;
function abrir_fechar_info(){
  if(botao_info==0){
    document.getElementById('box_info').style.display="block";
    botao_info=1;
  }else if(botao_info==1){
    document.getElementById('box_info').style.display="none";
    botao_info=0;
  }
}

function abrir_fechar_edit(event, el) {
  // Pega o elemento ancestral mais próximo em relação ao botão clicado
  var linha = el.closest('tr');
  var itens = linha.querySelectorAll('.revelar-item');
  // Icone dentro do botão
  var icone = el.querySelector('i');

  for (const item of itens) {
    // Verifica se a classe revelado existe no item
    var revelado = item.classList.contains('revelado');

    if (revelado) {
      icone.style.transform = 'rotate(0deg)';
      item.style.width = '0';
    } else {
      icone.style.transform = 'rotate(-180deg)';
      item.style.width = '30px';
    }
    
    // Alterna a classe revelado no item, colocando ou retirando
    item.classList.toggle('revelado');
  }
}

var answers={};

var questao_um= document.getElementById('questao-1');
var questao_dois= document.getElementById('questao-2');
var questao_tres= document.getElementById('questao-3');
var questao_quatro= document.getElementById('questao-4');
var questao_cinco= document.getElementById('questao-5');
var questao_seis= document.getElementById('questao-6');
var questao_sete= document.getElementById('questao-7');
var questao_oito= document.getElementById('questao-8');
var questao_nove= document.getElementById('questao-9');
var questao_dez= document.getElementById('questao-10');
var questao_onze= document.getElementById('questao-11');
var questao_doze= document.getElementById('questao-12');
var questao_treze= document.getElementById('questao-13');
var questao_quatorze= document.getElementById('questao-14');
var questao_quinze= document.getElementById('questao-15');

function storeAnswers(question_number, event){
  if(event.target.type === 'radio'){
    console.log(event.target.value);
    answers['question'+question_number]= parseInt(event.target.value);
    console.log(answers);
  }
}

questao_um.addEventListener('click', function(event){
  storeAnswers(1, event)
})
questao_dois.addEventListener('click', function(event){
  storeAnswers(2, event)
})
questao_tres.addEventListener('click', function(event){
  storeAnswers(3, event)
})
questao_quatro.addEventListener('click', function(event){
  storeAnswers(4, event)
})
questao_cinco.addEventListener('click', function(event){
  storeAnswers(5, event)
})
questao_seis.addEventListener('click', function(event){
  storeAnswers(6, event)
})
questao_sete.addEventListener('click', function(event){
  storeAnswers(7, event)
})
questao_oito.addEventListener('click', function(event){
  storeAnswers(8, event)
})
questao_nove.addEventListener('click', function(event){
  storeAnswers(9, event)
})
questao_dez.addEventListener('click', function(event){
  storeAnswers(10, event)
})
questao_onze.addEventListener('click', function(event){
  storeAnswers(11, event)
})
questao_doze.addEventListener('click', function(event){
  storeAnswers(12, event)
})
questao_treze.addEventListener('click', function(event){
  storeAnswers(13, event)
})
questao_quatorze.addEventListener('click', function(event){
  storeAnswers(14, event)
})
questao_quinze.addEventListener('click', function(event){
  storeAnswers(15, event)
})


function totalScore(){
  var total_score= 15 - (answers.question1 + answers.question2 +answers.question3+
                        answers.question4+answers.question5+answers.question6+answers.question7+answers.question8+
                        answers.question9+answers.question10+answers.question11+answers.question12+answers.question13+
                        answers.question14+answers.question15);

  return total_score;
  console.log("total score: "+totalScore());
}

function getInfoBasedOnScore(){
  if(totalScore() < 5){
    var score_info = 'Com base nas respostas, não é recomendado possuir mais de 1% do ativo em sua carteira'
  }else if (totalScore() >= 5  && totalScore() < 8){
    var score_info = 'Com base nas respostas, não é recomendado possuir mais de 10% do ativo em sua carteira'
  }else if(totalScore() >= 8 && totalScore() < 10){
    var score_info = 'Com base nas respostas, não é recomendado possuir mais de 15% do ativo em sua carteira'
  }else if(totalScore() >= 10 && totalScore() < 13){
    var score_info = 'Com base nas respostas, não é recomendado possuir mais de 25% do ativo em sua carteira'
  }else if (totalScore() >= 13 && totalScore() < 15){
    var score_info = 'Com base nas respostas, não é recomendado possuir mais de 35% do ativo em sua carteira'
  }else if(totalScore() >=15){
    var score_info = 'Com base nas respostas, não é recomendado possuir mais de 49% do ativo em sua carteira'
  }

  return score_info;
}

var submit1= document.getElementById('submit-1');
var submit2= document.getElementById('submit-2');
var submit3= document.getElementById('submit-3');
var submit4= document.getElementById('submit-4');
var submit5= document.getElementById('submit-5');
var submit6= document.getElementById('submit-6');
var submit7= document.getElementById('submit-7');
var submit8= document.getElementById('submit-8');
var submit9= document.getElementById('submit-9');
var submit10= document.getElementById('submit-10');
var submit11= document.getElementById('submit-11');
var submit12= document.getElementById('submit-12');
var submit13= document.getElementById('submit-13');
var submit14= document.getElementById('submit-14');
var submit15= document.getElementById('submit-15');

function nextQuestion(question_number){
  var current_question_number = question_number -1;
  var question_number = question_number.toString();
  var current_question_number = current_question_number.toString();


  var el= document.getElementById('questao-'+question_number);
  var el2= document.getElementById('questao-'+current_question_number);

    el.style.display = "block";
    el2.style.display = "none";
}

submit1.addEventListener('click', function(){
  nextQuestion(2);
  growProgressBar('13.3334%');
})
submit2.addEventListener('click', function(){
  nextQuestion(3);
  growProgressBar('20.0001%');
})
submit3.addEventListener('click', function(){
  nextQuestion(4);
  growProgressBar('26.6668%');
})
submit4.addEventListener('click', function(){
  nextQuestion(5);
  growProgressBar('33.3335%');
})
submit5.addEventListener('click', function(){
  nextQuestion(6);
  growProgressBar('40.0002%');
})
submit6.addEventListener('click', function(){
  nextQuestion(7);
  growProgressBar('46.6669%');
})
submit7.addEventListener('click', function(){
  nextQuestion(8);
  growProgressBar('53.3336%');
})
submit8.addEventListener('click', function(){
  nextQuestion(9);
  growProgressBar('60.0003%');
})
submit9.addEventListener('click', function(){
  nextQuestion(10);
  growProgressBar('66.667%');
})
submit10.addEventListener('click', function(){
  nextQuestion(11);
  growProgressBar('73.3337%');
})
submit11.addEventListener('click', function(){
  nextQuestion(12);
  growProgressBar('80.0004%');
})
submit12.addEventListener('click', function(){
  nextQuestion(13);
  growProgressBar('86.6671%');
})
submit13.addEventListener('click', function(){
  nextQuestion(14);
  growProgressBar('93.3338%');
})
submit14.addEventListener('click', function(){
  nextQuestion(15);
  growProgressBar('100%');
})
submit15.addEventListener('click', function(){
  nextQuestion(16);
})


submit15.addEventListener('click', function(){
  document.getElementById('printTotalScore').innerHTML = totalScore();
  document.getElementById('printScoreInfo').innerHTML = getInfoBasedOnScore();
})

function growProgressBar(percentage_width){
  var bar= document.getElementById('progress-bar');
  bar.style.width=percentage_width;
}