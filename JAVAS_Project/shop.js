// let products = {
//     data:
//     [
//         {
//             productName:"Smoky BBQ Chicken Wings",
//             category:"MainCourses",
//             price:"9.99",
//             discount:"-10%",
//             image:"../image2/shopImage/imgMainCourse/m2.jpg",
//         },
//
//         {
//             productName:"cheescake with blubarry",
//             category:"Desserts",
//             price:"30.00",
//             discount:"-15%",
//             image:"../image2/shopImage/imgDessert/d7.jpeg",
//         },
//
//         {
//             productName:"Orange Juice",
//             category:"Drinks",
//             discount:"-10%",
//             price:"12.00",
//             image:"../image2/shopImage/imgdrink/dr3.jpeg",
//         },
//
//         {
//             productName:"Berry Cream Cheese Dessert with Mascarpone Mousse",
//             category:"Desserts",
//             price:"20.00",
//             discount:"-10%",
//             image:"../image2/shopImage/imgDessert/d1.jpg",
//         },
//
//         {
//             productName:"Grilled Octopus",
//             category:"MainCourses",
//             price:"60.00",
//             discount:"-15%",
//             image:"../image2/shopImage/imgMainCourse/m4.jpg",
//         },
//
//         {
//             productName:"Blueberry Cheesecake with Blueberry Compote",
//             category:"Desserts",
//             price:"35.00",
//             discount:"-20%",
//             image:"../image2/shopImage/imgDessert/d3.jpg",
//         },
//
//         {
//             productName:"Individual Berry Cheesecakes",
//             category:"Desserts",
//             price:"50.00",
//             discount:"-15%",
//             image:"../image2/shopImage/imgDessert/d8.jpg",
//         },
//
//         {
//             productName:"Pure Mango Juice",
//             category:"Drinks",
//             price:"15.00",
//             discount:"-15%",
//             image:"../image2/shopImage/imgdrink/dr2.jpeg",
//         },
//
//         {
//             productName:"Mini Lobster Tails with Black Truffle Purée",
//             category:"MainCourses",
//             price:"70.00",
//             discount:"-30%",
//             image:"../image2/shopImage/imgMainCourse/m5.jpg",
//         },
//
//         {
//           *  productName:"Chocolate Hazelnut Cake with Edible Gold",
//           *  category:"Desserts",
//           *  price:"25.00",
//           *  discount:"-15%",
//           *  image:"../image2/shopImage/imgDessert/d2.jpg",
//         },
//
//         {
//             productName:"Sparkling Cranberry Mocktails",
//             category:"Drinks",
//             price:"15.00",
//             discount:"-5%",
//             image:"../image2/shopImage/imgdrink/dr5.jpg",
//         },
//
//         {
//             productName:"cake for Knoww",********************************
//             category:"Desserts",
//             price:"25.00",
//             discount:"-15%",
//             image:"../image2/shopImage/imgDessert/d4.jpg",
//         },
//
//         {
//             productName:"Raspberry Coulis with Vanilla Panna Cotta",***************************
//             category:"Desserts",
//             price:"30.00",
//             discount:"-20%",
//             image:"../image2/shopImage/imgDessert/d5.jpg",
//         },
//
//         {
//             productName:"chocolate FOR NOW",*************************
//             category:"Desserts",
//             price:"25.00",
//             discount:"-40%",
//             image:"../image2/shopImage/imgDessert/d6.jpeg",
//         },
//
//         {
//             productName:"Herb-Grilled Lamb Chops",
//             category:"MainCourses",
//             price:"25.00",
//             discount:"-30%",
//             image:"../image2/shopImage/imgMainCourse/m3.jpg",
//         },
//
//         {
//             productName:"Raspberry & Coconut Parfait",**************************
//             category:"Desserts",
//             price:"40.00",
//             discount:"-15%",
//             image:"../image2/shopImage/imgDessert/d9.jpg",
//         },
//
//         {
//             productName:"Hot Cocoa with Caramel Whipped Cream",
//             category:"Drinks",
//             discount:"-15%",
//             price:"7.00",
//             image:"../image2/shopImage/imgdrink/dr6.jpeg",
//         },
//
//         {
//             productName:"Beef Pho",
//             category:"MainCourses",
//             price:"15.00",
//             discount:"-30%",
//             image:"../image2/shopImage/imgMainCourse/m1.jpg",
//         },
//         {
//             productName:"Fresh Strawberry Juice",
//             category:"Drinks",
//             price:"15.00",
//             discount:"-10%",
//             image:"../image2/shopImage/imgdrink/dr4.jpeg",
//         },
//
//         {
//             productName:"i dont know now",
//             category:"MainCourses",
//             price:"50.00",
//             discount:"-50%",
//             image:"../image2/shopImage/imgMainCourse/m6.jpeg",
//         },
//
//         {
//             productName:"i dont know now2",
//             category:"MainCourses",
//             price:"30.00",
//             discount:"-15%",
//             image:"../image2/shopImage/imgMainCourse/m7.jpeg",
//         },
//
//         {
//             productName:"Braised Duck Leg with Orange Sauce",
//             category:"MainCourses",
//             price:"50.00",
//             discount:"-70%",
//             image:"../image2/shopImage/imgMainCourse/m8.jpg",
//         },
//
//         {
//             productName:"Garlic Butter Shrimp Skillet",
//             category:"MainCourses",
//             price:"70.00",
//             discount:"-30%",
//             image:"../image2/shopImage/imgMainCourse/m9.jpeg",
//         },
//         {
//             productName:"Fresh Berry Juice",
//             category:"Drinks",
//             price:"10.00",
//             discount:"-15%",
//             image:"../image2/shopImage/imgdrink/dr1.jpeg",
//         },
//
//         {
//             productName:"Grilled Ribeye Steak",
//             category:"MainCourses",
//             price:"55.00",
//             discount:"-50%",
//             image:"../image2/shopImage/imgMainCourse/m10.jpeg",
//         },
//     ],
// };
//
// function scrollToTop() {
//     window.scrollTo({ top: 0, behavior: 'smooth' });
// }
//
//
// for(let i of products.data)
// {
//     //create card
//     let card=document.createElement("div");
//
//     //card should have category and should stay hidden initially
//     card.classList.add("card",i.category,"hide");
//
//     //image div
//     let imageContainer = document.createElement("div");
//     imageContainer.classList.add("image-container");
//
//     //img tag
//     let image = document.createElement("img");
//     image.setAttribute("src",i.image);
//     imageContainer.appendChild(image);
//     //span tag
//     let discount = document.createElement("span");
//     discount.classList.add("discount");
//     discount.innerText=i.discount;
//     imageContainer.appendChild(discount);
//
//
//     card.appendChild(imageContainer);
//
//     //container
//     let container=document.createElement("div");
//     container.classList.add("container");
//
//     let buttonAddToCart = document.createElement("button");
//     buttonAddToCart.classList.add("button-addToCart");
//     buttonAddToCart.innerText="ADD TO CART";
//     container.appendChild(buttonAddToCart);
//
//     //product name
//     let name = document.createElement("h5");
//     name.classList.add("product-name");
//     name.innerText=i.productName
//     container.appendChild(name);
//
//     //price
//     let price= document.createElement("h6");
//     price.innerText = "$" + i.price;
//     container.appendChild(price);
//
//
//     card.appendChild(container);
//
//
//     document.getElementById("products").appendChild(card);
// }
//
// //parameter passed from button (parameter same as category)
// function filterProduct(value) {
//     //Button class code
//     let buttons = document.querySelectorAll(".button-value")
//     buttons.forEach((button)=>{
//         //check if value equals innerText
//         if(value == button.innerText)
//         {
//             button.classList.add("active");
//         }
//         else
//         {
//             button.classList.remove("active")
//         }
//     });
//
//     //select all cards
//     let elements = document.querySelectorAll(".card");
//
//     //loop through all cards
//     elements.forEach((element)=>{
//         //display all cards on 'all' button click
//         if(value =="all")
//         {
//             element.classList.remove("hide");
//         }
//
//         else
//         {
//             //check if element contains category class
//             if (element.classList.contains(value))
//             {
//                 //display element based on category
//                 element.classList.remove("hide");
//             }
//             else
//             {
//                 //hide other elemnts
//                 element.classList.add("hide");
//             }
//         }
//     });
// }
//
// //search button click
// document.getElementById("search").addEventListener
// ("click",() => {
//     //initialization
//     let searchInput = document.getElementById("search_input").value;
//     let elements = document.querySelectorAll(".product-name");
//     let cards = document.querySelectorAll(".card");
//
//     //loop through all elements
//     elements.forEach((element,index) => {
//         //check if text include the search value
//         if(element.innerText.includes(searchInput)){
//             //display matching card
//             cards[index].classList.remove("hide");
//         }
//         else
//         {
//             //hide other
//             cards[index].classList.add("hide");
//         }
//     });
// });
//
// //initially display all products
// window.onload = () => {
//     filterProduct("all");
// };



var product_id = document.getElementsByClassName("button-addToCart");
for (var i = 0; i < product_id.length; i++) {
    product_id[i].addEventListener("click", function(event) {
        var target = event.target;
        var id = target.getAttribute("data-id");
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data=JSON.parse(this.responseText);
                target.innerHTML=data.in_cart;
                document.getElementById("badge").innerHTML= data.num_cart ;

            }
        }
        xml.open("GET", "../PHP_Project/add_to_cart.php?id="+id, true);
        xml.send();
    });
}
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
document.addEventListener('DOMContentLoaded', function () {
    const filterButtons = document.querySelectorAll('.button-value');
    const sortSelect = document.querySelector('.selectByOrder');
    const productsContainer = document.getElementById('products');
    const allProducts = Array.from(productsContainer.querySelectorAll('.card'));

    // تصفية المنتجات حسب الفئة
    function filterProduct(category) {
        allProducts.forEach(product => {
            const productCategory = product.getAttribute('data-category');
            if (category === 'all' || productCategory === category) {
                product.style.display = 'block';
            } else {
                product.style.display = 'none';
            }
        });

        // إعادة تعيين اختيار الترتيب إلى "Sort by"
        sortSelect.innerHTML = `
            <option value=""  disabled>Sort by</option>
            <option value="popularity">Sort by popularity</option>
            <option value="lowToHigh">Sort by Price: Low to High</option>
            <option value="highToLow">Sort by Price: High to Low</option>
        `;
        sortSelect.value = '';

        // إزالة كلاس active من كل الأزرار
        filterButtons.forEach(button => button.classList.remove('active'));
        // إضافة كلاس active للزر المختار
        const activeButton = Array.from(filterButtons).find(button => button.getAttribute('data-filter') === category);
        if (activeButton) {
            activeButton.classList.add('active');
        }
    }

    // ترتيب المنتجات حسب القيمة المختارة
    function sortProducts() {
        const sortValue = sortSelect.value;

        // نعرض كل المنتجات (زي "All") قبل الترتيب
        filterProduct('all');

        // نفرز كل المنتجات (مش بس الظاهرة)
        let visibleProducts = allProducts;

        if (sortValue === 'popularity') {
            visibleProducts.sort((a, b) => {
                return parseInt(b.getAttribute('data-popularity')) - parseInt(a.getAttribute('data-popularity'));
            });
        } else if (sortValue === 'lowToHigh') {
            visibleProducts.sort((a, b) => {
                return parseFloat(a.getAttribute('data-price')) - parseFloat(b.getAttribute('data-price'));
            });
        } else if (sortValue === 'highToLow') {
            visibleProducts.sort((a, b) => {
                return parseFloat(b.getAttribute('data-price')) - parseFloat(a.getAttribute('data-price'));
            });
        }

        // إعادة ترتيب المنتجات في DOM حسب الترتيب
        visibleProducts.forEach(product => {
            productsContainer.appendChild(product);
        });

        // إزالة كلاس active من كل الأزرار لما يتم اختيار ترتيب
        filterButtons.forEach(button => button.classList.remove('active'));

        // إعادة ترتيب الخيارات في <select> بحيث الخيار المختار يبقى الأول
        if (sortValue) { // نتحقق إن فيه خيار مختار (مش "Sort by")
            const options = Array.from(sortSelect.options);
            const selectedOption = options.find(opt => opt.value === sortValue);
            const defaultOption = options.find(opt => opt.value === '');
            const otherOptions = options.filter(opt => opt.value !== '' && opt.value !== sortValue);

            const newOptions = [selectedOption.cloneNode(true), defaultOption.cloneNode(true), ...otherOptions.map(opt => opt.cloneNode(true))];

            sortSelect.innerHTML = '';
            newOptions.forEach(opt => sortSelect.appendChild(opt));
            sortSelect.value = sortValue;
        }
    }

    // ربط أزرار الفلترة
    filterButtons.forEach(button => {
        button.addEventListener('click', function () {
            const filterValue = this.getAttribute('data-filter');
            filterProduct(filterValue);
        });
    });

    // ربط قائمة الترتيب
    sortSelect.addEventListener('change', sortProducts);

    // تلوين "All" لما الصفحة تحمل
    const allButton = Array.from(filterButtons).find(button => button.getAttribute('data-filter') === 'all');
    if (allButton) {
        allButton.classList.add('active');
    }
});


// دالة البحث
function searchProducts() {
    const searchInput = document.getElementById('search_input').value.toLowerCase();
    const cards = document.querySelectorAll('.card');

    cards.forEach(card => {
        const productName = card.getAttribute('data-name').toLowerCase();
        if (productName.includes(searchInput)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}



