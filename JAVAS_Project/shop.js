let products = {
    data:
    [
        {
            productName:"Beef Pho",
            category:"MainCourses",
            price:"15",
            image:"../image2/shopImage/imgMainCourse/m1.jpg",
        },

        {
            productName:"Smoky BBQ Chicken Wings",
            category:"MainCourses",
            price:"9.99",
            image:"../image2/shopImage/imgMainCourse/m2.jpg",
        },

        {
            productName:"Herb-Grilled Lamb Chops",
            category:"MainCourses",
            price:"25",
            image:"../image2/shopImage/imgMainCourse/m3.jpg",
        },

        {
            productName:"Grilled Octopus",
            category:"MainCourses",
            price:"60",
            image:"../image2/shopImage/imgMainCourse/m4.jpg",
        },

        {
            productName:"Mini Lobster Tails with Black Truffle Purée",
            category:"MainCourses",
            price:"70",
            image:"../image2/shopImage/imgMainCourse/m5.jpg",
        },

        {
            productName:"i dont know now",
            category:"MainCourses",
            price:"50",
            image:"../image2/shopImage/imgMainCourse/m6.jpeg",
        },

        {
            productName:"i dont know now2",
            category:"MainCourses",
            price:"30",
            image:"../image2/shopImage/imgMainCourse/m7.jpeg",
        },

        {
            productName:"Braised Duck Leg with Orange Sauce",
            category:"MainCourses",
            price:"50",
            image:"../image2/shopImage/imgMainCourse/m8.jpg",
        },

        {
            productName:"Garlic Butter Shrimp Skillet",
            category:"MainCourses",
            price:"70",
            image:"../image2/shopImage/imgMainCourse/m9.jpeg",
        },

        {
            productName:"Grilled Ribeye Steak",
            category:"MainCourses",
            price:"55",
            image:"../image2/shopImage/imgMainCourse/m10.jpeg",
        },
// ***********************************************************************************************************************
        {
            productName:"ine Dining Berry Cream Cheese Dessert with Mascarpone Mousse",
            category:"Desserts",
            price:"20",
            image:"../image2/shopImage/imgDessert/d1.jpg",
        },

        {
            productName:"Chocolate Hazelnut Cake with Edible Gold",
            category:"Desserts",
            price:"25",
            image:"../image2/shopImage/imgDessert/d2.jpg",
        },

        {
            productName:"Blueberry Cheesecake with Blueberry Compote",
            category:"Desserts",
            price:"35",
            image:"../image2/shopImage/imgDessert/d3.jpg",
        },

        {
            productName:"cake for Knoww",
            category:"Desserts",
            price:"25",
            image:"../image2/shopImage/imgDessert/d4.jpg",
        },

        {
            productName:"Raspberry Coulis with Vanilla Panna Cotta",
            category:"Desserts",
            price:"30",
            image:"../image2/shopImage/imgDessert/d5.jpg",
        },

        {
            productName:"chocolate FOR NOW",
            category:"Desserts",
            price:"25",
            image:"../image2/shopImage/imgDessert/d6.jpeg",
        },

        {
            productName:"cheescake with blubarry",
            category:"Desserts",
            price:"30",
            image:"../image2/shopImage/imgDessert/d7.jpeg",
        },

        {
            productName:"Individual Berry Cheesecakes",
            category:"Desserts",
            price:"50",
            image:"../image2/shopImage/imgDessert/d8.jpg",
        },

        {
            productName:"Raspberry & Coconut Parfait",
            category:"Desserts",
            price:"40",
            image:"../image2/shopImage/imgDessert/d9.jpg",
        },
// ***********************************************************************************************************************
        {
            productName:"Fresh Berry Juice",
            category:"Drinks",
            price:"10",
            image:"../image2/shopImage/imgdrink/dr1.jpeg",
        },

        {
            productName:"Pure Mango Juice",
            category:"Drinks",
            price:"15",
            image:"../image2/shopImage/imgdrink/dr2.jpeg",
        },

        {
            productName:"Orange Juice",
            category:"Drinks",
            price:"12",
            image:"../image2/shopImage/imgdrink/dr3.jpeg",
        },

        {
            productName:"Fresh Strawberry Juice",
            category:"Drinks",
            price:"15",
            image:"../image2/shopImage/imgdrink/dr4.jpeg",
        },

        {
            productName:"Sparkling Cranberry Mocktails",
            category:"Drinks",
            price:"15",
            image:"../image2/shopImage/imgdrink/dr5.jpg",
        },

        {
            productName:"Hot Cocoa with Caramel Whipped Cream",
            category:"Drinks",
            price:"7",
            image:"../image2/shopImage/imgdrink/dr6.jpeg",
        },
    ],
};

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
    card.appendChild(imageContainer);

    //container
    let container=document.createElement("div");
    container.classList.add("container");

    //product name
    let name = document.createElement("h5");
    name.classList.add("product-name");
    name.innerText=i.productName.toUpperCase();
    container.appendChild(name);

    //price
    let price= document.createElement("h6");
    price.innerText = "$" + i.price;
    container.appendChild(price);

    card.appendChild(container)

    document.getElementById("products").appendChild(card);
}

//parameter passed from button (parameter same as category)
function filterProduct(value) {
    //Button class code
    let buttons = document.querySelectorAll(".button-value")
    buttons.forEach((button)=>{
        //check if value equals innerText
        if(value.toUpperCase()==button.innerText.toUpperCase())
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

//initially display all products
window.onload = () => {
    filterProduct("all");
};
