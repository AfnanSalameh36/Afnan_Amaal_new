let products = {
    data:
    [
        {
            productName:"Smoky BBQ Chicken Wings",
            category:"MainCourses",
            price:"9.99",
            discount:"-10%",
            image:"../image2/shopImage/imgMainCourse/m2.jpg",
        },

        {
            productName:"cheescake with blubarry",
            category:"Desserts",
            price:"30.00",
            discount:"-15%",
            image:"../image2/shopImage/imgDessert/d7.jpeg",
        },

        {
            productName:"Orange Juice",
            category:"Drinks",
            discount:"-10%",
            price:"12.00",
            image:"../image2/shopImage/imgdrink/dr3.jpeg",
        },

        {
            productName:"Berry Cream Cheese Dessert with Mascarpone Mousse",
            category:"Desserts",
            price:"20.00",
            discount:"-10%",
            image:"../image2/shopImage/imgDessert/d1.jpg",
        },

        {
            productName:"Grilled Octopus",
            category:"MainCourses",
            price:"60.00",
            discount:"-15%",
            image:"../image2/shopImage/imgMainCourse/m4.jpg",
        },

        {
            productName:"Blueberry Cheesecake with Blueberry Compote",
            category:"Desserts",
            price:"35.00",
            discount:"-20%",
            image:"../image2/shopImage/imgDessert/d3.jpg",
        },

        {
            productName:"Individual Berry Cheesecakes",
            category:"Desserts",
            price:"50.00",
            discount:"-15%",
            image:"../image2/shopImage/imgDessert/d8.jpg",
        },

        {
            productName:"Pure Mango Juice",
            category:"Drinks",
            price:"15.00",
            discount:"-15%",
            image:"../image2/shopImage/imgdrink/dr2.jpeg",
        },

        {
            productName:"Mini Lobster Tails with Black Truffle Purée",
            category:"MainCourses",
            price:"70.00",
            discount:"-30%",
            image:"../image2/shopImage/imgMainCourse/m5.jpg",
        },

        {
            productName:"Chocolate Hazelnut Cake with Edible Gold",
            category:"Desserts",
            price:"25.00",
            discount:"-15%",
            image:"../image2/shopImage/imgDessert/d2.jpg",
        },

        {
            productName:"Sparkling Cranberry Mocktails",
            category:"Drinks",
            price:"15.00",
            discount:"-5%",
            image:"../image2/shopImage/imgdrink/dr5.jpg",
        },

        {
            productName:"cake for Knoww",
            category:"Desserts",
            price:"25.00",
            discount:"-15%",
            image:"../image2/shopImage/imgDessert/d4.jpg",
        },

        {
            productName:"Raspberry Coulis with Vanilla Panna Cotta",
            category:"Desserts",
            price:"30.00",
            discount:"-20%",
            image:"../image2/shopImage/imgDessert/d5.jpg",
        },

        {
            productName:"chocolate FOR NOW",
            category:"Desserts",
            price:"25.00",
            discount:"-40%",
            image:"../image2/shopImage/imgDessert/d6.jpeg",
        },

        {
            productName:"Herb-Grilled Lamb Chops",
            category:"MainCourses",
            price:"25.00",
            discount:"-30%",
            image:"../image2/shopImage/imgMainCourse/m3.jpg",
        },

        {
            productName:"Raspberry & Coconut Parfait",
            category:"Desserts",
            price:"40.00",
            discount:"-15%",
            image:"../image2/shopImage/imgDessert/d9.jpg",
        },

        {
            productName:"Hot Cocoa with Caramel Whipped Cream",
            category:"Drinks",
            discount:"-15%",
            price:"7.00",
            image:"../image2/shopImage/imgdrink/dr6.jpeg",
        },

        {
            productName:"Beef Pho",
            category:"MainCourses",
            price:"15.00",
            discount:"-30%",
            image:"../image2/shopImage/imgMainCourse/m1.jpg",
        },
        {
            productName:"Fresh Strawberry Juice",
            category:"Drinks",
            price:"15.00",
            discount:"-10%",
            image:"../image2/shopImage/imgdrink/dr4.jpeg",
        },

        {
            productName:"i dont know now",
            category:"MainCourses",
            price:"50.00",
            discount:"-50%",
            image:"../image2/shopImage/imgMainCourse/m6.jpeg",
        },

        {
            productName:"i dont know now2",
            category:"MainCourses",
            price:"30.00",
            discount:"-15%",
            image:"../image2/shopImage/imgMainCourse/m7.jpeg",
        },

        {
            productName:"Braised Duck Leg with Orange Sauce",
            category:"MainCourses",
            price:"50.00",
            discount:"-70%",
            image:"../image2/shopImage/imgMainCourse/m8.jpg",
        },

        {
            productName:"Garlic Butter Shrimp Skillet",
            category:"MainCourses",
            price:"70.00",
            discount:"-30%",
            image:"../image2/shopImage/imgMainCourse/m9.jpeg",
        },
        {
            productName:"Fresh Berry Juice",
            category:"Drinks",
            price:"10.00",
            discount:"-15%",
            image:"../image2/shopImage/imgdrink/dr1.jpeg",
        },

        {
            productName:"Grilled Ribeye Steak",
            category:"MainCourses",
            price:"55.00",
            discount:"-50%",
            image:"../image2/shopImage/imgMainCourse/m10.jpeg",
        },
    ],
};

function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}


for(let i of products.data)
{
    //create card
    let card=document.createElement("div");

    //card should have category and should stay hidden initially
    card.classList.add("card",i.category,"hide");

    //image div
    let imageContainer = document.createElement("div");
    imageContainer.classList.add("image-container");

    //img tag
    let image = document.createElement("img");
    image.setAttribute("src",i.image);
    imageContainer.appendChild(image);
    //span tag
    let discount = document.createElement("span");
    discount.classList.add("discount");
    discount.innerText=i.discount;
    imageContainer.appendChild(discount);


    card.appendChild(imageContainer);

    //container
    let container=document.createElement("div");
    container.classList.add("container");

    let buttonAddToCart = document.createElement("button");
    buttonAddToCart.classList.add("button-addToCart");
    buttonAddToCart.innerText="ADD TO CART";
    container.appendChild(buttonAddToCart);

    //product name
    let name = document.createElement("h5");
    name.classList.add("product-name");
    name.innerText=i.productName
    container.appendChild(name);

    //price
    let price= document.createElement("h6");
    price.innerText = "$" + i.price;
    container.appendChild(price);


    card.appendChild(container);


    document.getElementById("products").appendChild(card);
}

//parameter passed from button (parameter same as category)
function filterProduct(value) {
    //Button class code
    let buttons = document.querySelectorAll(".button-value")
    buttons.forEach((button)=>{
        //check if value equals innerText
        if(value == button.innerText)
        {
            button.classList.add("active");
        }
        else
        {
            button.classList.remove("active")
        }
    });

    //select all cards
    let elements = document.querySelectorAll(".card");

    //loop through all cards
    elements.forEach((element)=>{
        //display all cards on 'all' button click
        if(value =="all")
        {
            element.classList.remove("hide");
        }

        else
        {
            //check if element contains category class
            if (element.classList.contains(value))
            {
                //display element based on category
                element.classList.remove("hide");
            }
            else
            {
                //hide other elemnts
                element.classList.add("hide");
            }
        }
    });
}

//search button click
document.getElementById("search").addEventListener
("click",() => {
    //initialization
    let searchInput = document.getElementById("search_input").value;
    let elements = document.querySelectorAll(".product-name");
    let cards = document.querySelectorAll(".card");

    //loop through all elements
    elements.forEach((element,index) => {
        //check if text include the search value
        if(element.innerText.includes(searchInput)){
            //display matching card
            cards[index].classList.remove("hide");
        }
        else
        {
            //hide other
            cards[index].classList.add("hide");
        }
    });
});

//initially display all products
window.onload = () => {
    filterProduct("all");
};
