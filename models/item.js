const mongoose = require("mongoose")

let ItemSchema = mongoose.Schema({
    cost:  {type: Number, require: true, default: 0},
    name:  {type: String, default: "NoName"},
    stock: {type: Number, require: true, default: 0}
})
module.exports = mongoose.model("Item", ItemSchema)
