const express = require("express")
const bodyParser = require("body-parser");
const mongoose = require("mongoose")
const config = require("./config/database")
const Fixtures = require("./config/fixtures")

/* DB */
mongoose.connect(config.database);
mongoose.connection.on("connected", () => {
    ["armories", "items", "locations", "people", "groups", "missions"].forEach(
        value => mongoose.connection.dropCollection(value, err => {})
    )
    new Fixtures
})
/* ROUTING PARAMETERS */
const app = express()
const port =  8080
const armory = require("./routes/armory")
const group = require("./routes/group")
const location = require("./routes/location")
const mission = require("./routes/mission")
/* SERVER */
app.use(bodyParser.json())
app.use("/armory", armory)
app.use("/group", group)
app.use("/location", location)
app.use("/mission", mission)
app.get("/", (req, res) => res.status(200).send("First GET."))
app.listen(port, () => console.log(`Listening to port ${port}`))
