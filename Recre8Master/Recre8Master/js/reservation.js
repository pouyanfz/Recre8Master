// (C) Pouyan Forouzandeh
function errorMessageCreator_HomePage(errorMessage) {
    if (errorMessage.includes("database exists")){
        return "Database already exists";
    } else if (errorMessage.includes("database doesn't exist")){
        return "Database already deleted";
    } else if (errorMessage.includes("Unknown database")){
        return "Create Database first";
    } else if (errorMessage.includes("Unknown table")) {
        return "Table doesn't exist";
    } else if (errorMessage.includes("table or view already exists")){
        return "Table already exists";
    } else {
        return errorMessage;
    }
}

function errorMessageCreator_insert(errorMessage) {
    if (errorMessage.includes("''")){
        return "Enter Data before submitting!";
    } else if (errorMessage.includes("Duplicate entry")){
        return "A club with this name already exists in the database";
    } else if (errorMessage.includes("too long")){
        return "Entered data exceeds limits";
    } else if (errorMessage.includes("doesn't exist")){
        return "Create Table in the Homepage First";
    } else {
        return errorMessage;
    }
}

function errorMessageCreator_other(errorMessage) {
    if (errorMessage.includes("doesn't exist")){
        return "Create Table in the Homepage First";
    } else if (errorMessage.includes("Unknown database")) {
        return "Create Database in the Homepage First";
    } else {
        return errorMessage;
    }
}