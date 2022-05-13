const people=[{name:"A太郎",age:18},{name:"B子",age:19},{name:"C之助",age:21},{name:"D美",age:22}];
const numbers=[29342,45342,23419283,148458552];

document.querySelector("button").onclick=()=>{

	console.log("一問目出力結果");
	let i=0;
	while(i<people.length){
		if(people[i].age<=20){
			console.log(people[i].name+"さんの年齢は"+people[i].age+"歳です。20歳まで"+(20-people[i].age)+"年です。");
		}
		else{
			console.log(people[i].name+"さんの年齢は"+people[i].age+"歳です。20歳を超えています。");
		}
		i++;
	}

	console.log("二問目出力結果");
	for(number of numbers){
		if(number%2==1){
			console.log(number+"は奇数です。7で割ったあまりは"+number%7+"です。");
		}
		else{
			console.log(number+"は偶数です。7で割ったあまりは"+number%7+"です。");
		}
	}

}