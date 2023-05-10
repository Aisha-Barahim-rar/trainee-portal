import './bootstrap'

import Alpine from 'alpinejs'
import collapse from '@alpinejs/collapse'
import PerfectScrollbar from 'perfect-scrollbar'

window.PerfectScrollbar = PerfectScrollbar




document.addEventListener('alpine:init', () => {
Alpine.data('mainState', () => {
let lastScrollTop = 0
const init = function () {
window.addEventListener('scroll', () => {
let st =
window.pageYOffset || document.documentElement.scrollTop
if (st > lastScrollTop) {
// downscroll
this.scrollingDown = true
this.scrollingUp = false
} else {
// upscroll
this.scrollingDown = false
this.scrollingUp = true
if (st == 0) {
// reset
this.scrollingDown = false
this.scrollingUp = false
}
}
lastScrollTop = st <= 0 ? 0 : st // For Mobile or negative scrolling 
}) 
} 
const getTheme=()=> {
    if (window.localStorage.getItem('dark')) {
    return JSON.parse(window.localStorage.getItem('dark'))
    }
    return (
    !!window.matchMedia &&
    window.matchMedia('(prefers-color-scheme: dark)').matches
    )
    }
    const setTheme = (value) => {
    window.localStorage.setItem('dark', value)
    }
    return {
    init,
    isDarkMode: getTheme(),
    toggleTheme() {
    this.isDarkMode = !this.isDarkMode
    setTheme(this.isDarkMode)
    },
    isSidebarOpen: window.innerWidth > 1024,
    isSidebarHovered: false,
    handleSidebarHover(value) {
    if (window.innerWidth < 1024) { 
        return
     } 
     this.isSidebarHovered=value 
    }, 
    handleWindowResize() { 
        if (window.innerWidth
        <=1024) { 
            this.isSidebarOpen=false 
        } else { 
            this.isSidebarOpen=true 
        } 
    }, 
    scrollingDown: false, scrollingUp:
        false, } }) }) 
        

        window.addEventListener("DOMContentLoaded", (e) => {

            function myFunction(i) {
                var button_id = document.getElementById(i).getAttribute('id');

                document.querySelector('#row' + button_id + '').remove();
            }
            

            document.getElementById("add").onclick = function() {myFunction2()};

            function myFunction2() {
                var table = document.getElementById("dynamic_field");
                var i = (table.rows[table.rows.length-1].getAttribute('id')).substr(3);
                i++;
                document.querySelector('#dynamic_field').insertAdjacentHTML("beforeend",
                `<tr id="row${i}">
                    <td class="px-2 py-2 border border-slate-300">
                        <input id="topic" name="practical_evaluation[${i}][0]" type="text" class="px-2 py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring
                        focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1
                        dark:text-gray-300 dark:focus:ring-offset-dark-eval-1 block w-full"
                            autofocus autocomplete="topic" />
                    </td>
                    <td class="px-2 py-2 border border-slate-300">
                        <input id="start_date" name="practical_evaluation[${i}][1]" type="text" class="px-2 py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring
                        focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1
                        dark:text-gray-300 dark:focus:ring-offset-dark-eval-1 block w-full"
                            autofocus autocomplete="start_date" />
                    </td>
                    <td class="px-2 py-2 border border-slate-300">
                        <input id="end_date" name="practical_evaluation[${i}][2]" type="text" class="px-2 py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring
                        focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1
                        dark:text-gray-300 dark:focus:ring-offset-dark-eval-1 block w-full"
                            autofocus autocomplete="end_date" />
                    </td>
                    <td class="px-2 py-2 border border-slate-300">
                        <input id="employee" name="practical_evaluation[${i}][3]" type="text" class="px-2 py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring
                        focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1
                        dark:text-gray-300 dark:focus:ring-offset-dark-eval-1 block w-full"
                            autofocus autocomplete="employee" />
                    </td>
                    <td class="px-2 py-2 border border-slate-300">
                        <input id="department" name="practical_evaluation[${i}][4]" type="text" class="px-2 py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring
                        focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1
                        dark:text-gray-300 dark:focus:ring-offset-dark-eval-1 block w-full"
                            autofocus autocomplete="department" />
                            
                    </td>
                    <td class="px-2 py-2 border border-slate-300">
    

                        <select class="px-4 py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring
            focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1
            dark:text-gray-300 dark:focus:ring-offset-dark-eval-1 block w-full" id="select" name="practical_evaluation[${i}][5]">
<option value="">
                                                        </option>
                                                        <option value="1">1
                                                        </option>
                                                        <option value="2">2
                                                        </option>
                                                        <option value="3">3
                                                        </option>
                                                        <option value="4">
                                                            4</option>
                                                        <option value="5">
                                                            5</option>

</select>
                    </td>
                    <td class="px-2 py-2 border border-slate-300">

                        <button type="button" name="remove" id="${i}" class="btn_remove inline-flex items-center transition-colors font-medium select-none disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none focus:ring focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-eval-2 px-2.5 py-1.5 text-sm bg-red-500 text-white hover:bg-red-600 focus:ring-red-500 rounded-md rounded-l-md border-t border-b border-r">
        <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4"></path>
</svg>
            </button>
                    </td>
                </tr>`
                );

                document.getElementById(i).onclick = function() {myFunction(i)};
            }


          });


        Alpine.plugin(collapse)

        Alpine.start()
