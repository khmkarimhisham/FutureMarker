package compiler_api;

import org.json.simple.JSONObject;

public class run {

    public static void main(String[] args) {
        JSONObject result = compileTest.compileCode(args[0]);
        System.out.println(result);
    }
}
