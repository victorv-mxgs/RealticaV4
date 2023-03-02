document.addEventListener("DOMContentLoaded",(e)=>{
    const includeHTML=(el,url)=>{

        const xhr=new XMLHttpRequest();

        xhr.addEventListener("readystatechange",e=>{
            if(xhr.readyState !==4)return;

            if(xhr.status>=200 && xhr.status<300){
                el.outerHTML=xhr.responseText;
            }
            else{
                let message=xhr.statusText||"Error al cargar los archivos"
            }
        });


        xhr.open("GET",url);
        xhr.setRequestHeader("Content-type","text/html;charset=UTF-8");
        xhr.send();
        };

        document
        .querySelectorAll("[data-include]")
        .forEach((el)=>includeHTML(el, el.getAttribute("data-include")));
    
});