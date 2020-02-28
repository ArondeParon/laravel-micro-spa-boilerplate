"use strict";

import Route from "./Services/Router/VueRoute"

export default [
    /**
     * Fallback / Errors
     */
    Route
        .to('error', '/exception/:status(\\d+)')
        .view(()=>import(/*webpackChunkName:"base"*/ "@views/errors/Error"))
        .withParams({status: '404'}),
    Route
        .to('_fallback','*')
        .redirectTo(Route.link('error').withParams({status: '404'})),
]
