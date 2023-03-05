import ReactDOM from "react-dom/client";
import React, {StrictMode} from "react";
import {ProSidebarProvider, sidebarClasses, menuClasses} from 'react-pro-sidebar';
import { Sidebar, Menu, MenuItem, SubMenu } from 'react-pro-sidebar';

let sideBars = document.querySelectorAll('.react-side-bar')
if(sideBars.length > 0) {
    sideBars.forEach(sb=> {
        let rootSidebar = ReactDOM.createRoot(sb)
        let items = sb.getAttribute('data-items')
            ? JSON.parse(sb.getAttribute('data-items'))
            : []

        function Icon(props) {
            return <i className={props.name}></i>
        }

        const MappedItems = items.map((item, i)=> {
            return (
                <MenuItem key={i} onClick={()=> location.href = item.href} active={item.active} icon={<Icon name={item.icon} />}>
                    {item.label}
                </MenuItem>
            )
        })

        rootSidebar.render(
            <StrictMode>
                <ProSidebarProvider>
                    <Sidebar style={{height: '100%',backgroundColor: '#212529', width:'250px', borderRightStyle:'unset'}}
                         menuItemStyles={{
                             button: ({ level, active, disabled }) => {
                                 return {
                                     color: active ? '#212529' : 'rgba(255,255,255,.55)',
                                     '&:hover': {
                                         color: active ? 'rgba(255,255,255,.55)' : '#212529',
                                         backgroundColor: active ? '#212529' : 'rgba(255,255,255,.55)',
                                     },
                                     backgroundColor: active ? 'rgba(255,255,255,.55)' : '#212529',
                                 };
                             },
                         }}

                         rootStyles={{
                             [`.${sidebarClasses.container}`]: {
                                 backgroundColor: '#212529',
                                 color: 'rgba(255,255,255,.55)'
                             },

                             [`.${menuClasses.menuItemRoot}`]: {
                                 backgroundColor: '#212529',
                                 color: 'rgba(255,255,255,.55)',
                                 '&:hover': {
                                     color:'#212529',
                                     backgroundColor: 'rgba(255,255,255,.55)',
                                 },
                                 '&.ps-active': {
                                     color:'#212529',
                                     backgroundColor: 'rgba(255,255,255,.55)',
                                 },
                             }
                         }}
                    >
                        <Menu>
                            {MappedItems}
                        </Menu>
                    </Sidebar>
                </ProSidebarProvider>
            </StrictMode>
        )
    })
}
