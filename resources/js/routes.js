import Home from "./components/Home";
import Login from "./components/auth/Login";
import TicketsMain from "./components/tickets/Main";
import TicketsList from "./components/tickets/List";
import NewTicket from "./components/tickets/New";
import Ticket from "./components/tickets/View";


export const routes = [
    {
        path: '/',
        component: Home,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/login',
        component: Login
    },
    {
        path: '/tickets',
        component: TicketsMain,
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path: '/',
                component: TicketsList,
            },
            {
                path: 'new',
                component: NewTicket,
            },
            {
                path: ':id',
                component: Ticket,
            }
        ]
    }
];
